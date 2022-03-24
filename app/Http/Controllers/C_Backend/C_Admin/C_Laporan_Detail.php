<?php

namespace App\Http\Controllers\C_Backend\C_Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\tb_laporan;
use App\tb_laporan_detail;
use App\tb_laporan_detail_revisi;

use Carbon\Carbon;

use Response;

use File;

class C_Laporan_Detail extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
      $tb_laporan_detail = DB::table('tb_laporan_detail')
                          ->select(DB::raw('tb_laporan_detail.*,tb_nama_laporan.*,tb_laporan.*'))
                          ->join('tb_nama_laporan', 'tb_nama_laporan.id_nama_laporan', '=', 'tb_laporan_detail.id_nama_laporan')
                          ->join('tb_laporan', 'tb_laporan.id_laporan', '=', 'tb_laporan_detail.id_laporan')
                          ->where('tb_laporan.id_laporan', '=', $id)
                          ->whereNotIn('tb_laporan_detail.status_laporan_detail', ['draft'])
                          ->get();

      $laporan_yang_sudah_dimasukan = [];
      foreach ($tb_laporan_detail as $data) {
        $laporan_yang_sudah_dimasukan[] = $data->id_nama_laporan;
      }


      $tb_nama_laporan = DB::table('tb_nama_laporan')
                          ->select(DB::raw('tb_nama_laporan.*'))
                          ->whereNotIn('tb_nama_laporan.id_nama_laporan', $laporan_yang_sudah_dimasukan)
                          ->get();

      // dd($tb_laporan_detail);

      // dd($id);

      return view('V_Backend/V_Admin/V_Laporan_Detail',[
        'tb_laporan_detail'=>$tb_laporan_detail,
        'tb_nama_laporan'=>$tb_nama_laporan,
        'id_laporan'=>$id
      ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function tampil_form_revisi($id){
      $tb_laporan_detail = DB::table('tb_laporan_detail')
      ->select(DB::raw('tb_laporan_detail.*, tb_nama_laporan.*, tb_laporan_detail_revisi.catatan_revisi'))
      ->where('tb_laporan_detail.id_laporan_detail','=',$id)
      ->join('tb_nama_laporan', 'tb_nama_laporan.id_nama_laporan', '=', 'tb_laporan_detail.id_nama_laporan')
      ->join('tb_laporan', 'tb_laporan.id_laporan', '=', 'tb_laporan_detail.id_laporan')
      ->leftjoin('tb_laporan_detail_revisi', 'tb_laporan_detail_revisi.id_laporan_detail', '=', 'tb_laporan_detail.id_laporan_detail')
      ->get();

      echo json_encode($tb_laporan_detail);
    }

    public function laporan_detail_update_valid($id){

      $tb_laporan_detail = tb_laporan_detail::find($id);
      $tb_laporan_detail->status_laporan_detail = 'valid';
      $tb_laporan_detail->update();

      $ambi_id_laporan = DB::table('tb_laporan_detail')
      ->select(DB::raw('tb_laporan_detail.id_laporan'))
      ->where('tb_laporan_detail.id_laporan_detail','=',$id)
      ->first();

      // dd($ambi_id_laporan);
      $id_laporan = $ambi_id_laporan->id_laporan;

      $ambl_jumlah_laporan_detail_status_valid = DB::table('tb_laporan_detail')
      ->select(DB::raw('tb_laporan_detail.id_laporan_detail'))
      ->where('tb_laporan_detail.id_laporan','=',$id_laporan)
      ->where('tb_laporan_detail.status_laporan_detail', '=', 'valid')
      ->get();

      $ambl_jumlah_laporan_detail_status_revisi = DB::table('tb_laporan_detail')
      ->select(DB::raw('tb_laporan_detail.id_laporan_detail'))
      ->where('tb_laporan_detail.id_laporan','=',$id_laporan)
      ->where('tb_laporan_detail.status_laporan_detail', '=', 'revisi')
      ->get();

      $ambl_jumlah_laporan_detail_status_diajukan = DB::table('tb_laporan_detail')
      ->select(DB::raw('tb_laporan_detail.id_laporan_detail'))
      ->where('tb_laporan_detail.id_laporan','=',$id_laporan)
      ->where('tb_laporan_detail.status_laporan_detail', '=', 'diajukan')
      ->get();

      $ambil_jumlah_laporan_detail = DB::table('tb_laporan_detail')
      ->select(DB::raw('tb_laporan_detail.id_laporan_detail'))
      ->where('tb_laporan_detail.id_laporan','=',$id_laporan)
      ->get();

      // dd($ambl_jumlah_laporan_detail_status_valid->count());

      if($ambl_jumlah_laporan_detail_status_diajukan->count() == 0){

        if($ambl_jumlah_laporan_detail_status_valid->count() == $ambil_jumlah_laporan_detail->count()){ //jika jumlah laporan yang valid samadengan jumlah laporan maka update status laporan valid dan update status laporan_detail valid
          // dd(Carbon::now());
          $tgl_sekarang = Carbon::now();

          DB::statement("UPDATE tb_laporan
            SET tb_laporan.status_laporan = 'valid', tb_laporan.tanggal_konfirmasi_valid_laporan = '$tgl_sekarang'
            where tb_laporan.id_laporan = '$id_laporan'");

          return redirect('backend_admin_laporan');

        }else{

          $tgl_sekarang = Carbon::now();

          DB::statement("UPDATE tb_laporan
            SET tb_laporan.status_laporan = 'revisi', tb_laporan.tanggal_konfirmasi_valid_laporan = '$tgl_sekarang'
            where tb_laporan.id_laporan = '$id_laporan'");

          return redirect('backend_admin_laporan');

        }

      }else{

        return back();

      }



    }

    public function laporan_detail_update_revisi(Request $request){

      $id_laporan_detail = $request['id_laporan_detail'];

      $tb_laporan_detail = tb_laporan_detail::find($id_laporan_detail);
      $tb_laporan_detail->status_laporan_detail = 'revisi';
      $tb_laporan_detail->update();

      $ambil_jumlah_revisi = DB::table('tb_laporan_detail_revisi')
      ->select(DB::raw('tb_laporan_detail_revisi.*'))
      ->where('tb_laporan_detail_revisi.id_laporan_detail','=',$id_laporan_detail)
      ->get();

      // dd($ambil_jumlah_revisi->count());

      if($ambil_jumlah_revisi->count() == 0){
        $tb_laporan_detail_revisi_tambah = new tb_laporan_detail_revisi;
        $tb_laporan_detail_revisi_tambah->id_laporan_detail = $id_laporan_detail;
        $tb_laporan_detail_revisi_tambah->catatan_revisi = $request['catatan_revisi'];
        $tb_laporan_detail_revisi_tambah->save();
      }else{
        $catatan_revisi = $request['catatan_revisi'];
        DB::statement("UPDATE tb_laporan_detail_revisi
          SET tb_laporan_detail_revisi.catatan_revisi = '$catatan_revisi'
          where tb_laporan_detail_revisi.id_laporan_detail = '$id_laporan_detail'");
      }

      $ambi_id_laporan = DB::table('tb_laporan_detail')
      ->select(DB::raw('tb_laporan_detail.id_laporan'))
      ->where('tb_laporan_detail.id_laporan_detail','=',$id_laporan_detail)
      ->first();

      // dd($ambi_id_laporan);
      $id_laporan = $ambi_id_laporan->id_laporan;

      $ambl_jumlah_laporan_detail_status_valid = DB::table('tb_laporan_detail')
      ->select(DB::raw('tb_laporan_detail.id_laporan_detail'))
      ->where('tb_laporan_detail.id_laporan','=',$id_laporan)
      ->where('tb_laporan_detail.status_laporan_detail', '=', 'valid')
      ->get();

      $ambl_jumlah_laporan_detail_status_revisi = DB::table('tb_laporan_detail')
      ->select(DB::raw('tb_laporan_detail.id_laporan_detail'))
      ->where('tb_laporan_detail.id_laporan','=',$id_laporan)
      ->where('tb_laporan_detail.status_laporan_detail', '=', 'revisi')
      ->get();

      $ambl_jumlah_laporan_detail_status_diajukan = DB::table('tb_laporan_detail')
      ->select(DB::raw('tb_laporan_detail.id_laporan_detail'))
      ->where('tb_laporan_detail.id_laporan','=',$id_laporan)
      ->where('tb_laporan_detail.status_laporan_detail', '=', 'diajukan')
      ->get();

      $ambil_jumlah_laporan_detail = DB::table('tb_laporan_detail')
      ->select(DB::raw('tb_laporan_detail.id_laporan_detail'))
      ->where('tb_laporan_detail.id_laporan','=',$id_laporan)
      ->get();

      // dd($ambl_jumlah_laporan_detail_status_valid->count());

      if($ambl_jumlah_laporan_detail_status_diajukan->count() == 0){

        if($ambl_jumlah_laporan_detail_status_revisi->count() == $ambil_jumlah_laporan_detail->count()){ //jika jumlah laporan yang valid samadengan jumlah laporan maka update status laporan valid dan update status laporan_detail valid
          // dd(Carbon::now());
          $tgl_sekarang = Carbon::now();

          DB::statement("UPDATE tb_laporan
            SET tb_laporan.status_laporan = 'revisi', tb_laporan.tanggal_konfirmasi_valid_laporan = '$tgl_sekarang'
            where tb_laporan.id_laporan = '$id_laporan'");

          return redirect('backend_admin_laporan');

        }else{

          $tgl_sekarang = Carbon::now();

          DB::statement("UPDATE tb_laporan
            SET tb_laporan.status_laporan = 'revisi', tb_laporan.tanggal_konfirmasi_valid_laporan = '$tgl_sekarang'
            where tb_laporan.id_laporan = '$id_laporan'");

          return redirect('backend_admin_laporan');

        }

      }else{

        return back();

      }




    }


    public function download_file_laporan_pdf($nama_file)
    {

      $file = public_path(). "/File_Laporan/".$nama_file;

      return Response::make(file_get_contents($file), 200, [

        'Content-Type'=>'application/pdf',

        'Content-Type'=>'application/xlsx',

        'Content-Disposition' => 'inline; filename="'.$nama_file.'"'

      ]);
    }
}
