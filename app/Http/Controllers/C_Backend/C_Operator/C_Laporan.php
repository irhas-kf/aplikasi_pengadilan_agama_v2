<?php

namespace App\Http\Controllers\C_Backend\C_Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

use App\tb_laporan;
use App\tb_laporan_detail;

class C_Laporan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      $filter_data_tahun_operator_session = $request->session()->get('filter_data_tahun_operator');
      $tb_laporan = DB::table('tb_laporan')
                    ->select(DB::raw('*'))
                    ->where(DB::raw('SUBSTRING(bulan_tahun_laporan, 4, 4)'),'=', $filter_data_tahun_operator_session)
                    ->get();

      $tb_laporan_detail = DB::table('tb_laporan_detail')
                    ->select(DB::raw('*'))
                    ->get();

      return view('V_Backend/V_Operator/V_Laporan',[
        'tb_laporan'=>$tb_laporan,
        'tb_laporan_detail'=>$tb_laporan_detail
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

      $bulan_tahun_laporan = $request['laporan_bulan'].'-'.$request['laporan_tahun'];

      $tb_laporan = DB::table('tb_laporan')
      ->select(DB::raw('tb_laporan.*'))
      ->where('tb_laporan.bulan_tahun_laporan', '=', $bulan_tahun_laporan)
      ->get();

      // echo $tb_laporan->count();

      if($tb_laporan->count() == 0){// jika jumlah laporan sama dengan 0 maka tambah laporan
        $tb_laporan = new tb_laporan;
        $tb_laporan->judul_laporan = $request['judul_laporan'];
            // $tb_laporan->tanggal_upload_laporan = Carbon::now();
        $tb_laporan->bulan_tahun_laporan = $bulan_tahun_laporan;
        $tb_laporan->status_laporan = 'draft';
        $tb_laporan->save();

        return back();
      }else{ // jika tidak 0 maka peringatan
        return redirect()->back()->with('alert', 'maaf, bulan dan tahun sudah ada!');
      }



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
      $tb_laporan = DB::table('tb_laporan')
      ->select(DB::raw('tb_laporan.*'))
      ->where('tb_laporan.id_laporan','=',$id)
      ->get();

      echo json_encode($tb_laporan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      $bulan_tahun_laporan_edit = $request['laporan_bulan_edit'].'-'.$request['laporan_tahun_edit'];

      $ambil_laporan_bulan_tahun_berdsarkan_id_laporan = DB::table('tb_laporan')
      ->select(DB::raw('tb_laporan.*'))
      ->where('tb_laporan.id_laporan', '=', $request['id_laporan_edit'])
      ->first();

      $ambil_laporan_berdsarkan_bulan_tahun = DB::table('tb_laporan')
      ->select(DB::raw('tb_laporan.*'))
      ->where('tb_laporan.bulan_tahun_laporan', '=', $bulan_tahun_laporan_edit)
      ->get();
      // dd($tb_laporan->bulan_tahun_laporan);

      if($bulan_tahun_laporan_edit == $ambil_laporan_bulan_tahun_berdsarkan_id_laporan->bulan_tahun_laporan){
          $tb_laporan = tb_laporan::find($request['id_laporan_edit']);
          $tb_laporan->judul_laporan = $request['judul_laporan_edit'];
          $tb_laporan->update();

          return back();
      }else if($ambil_laporan_berdsarkan_bulan_tahun->count() == 0){
          $tb_laporan = tb_laporan::find($request['id_laporan_edit']);
          $tb_laporan->judul_laporan = $request['judul_laporan_edit'];
          $tb_laporan->bulan_tahun_laporan = $bulan_tahun_laporan_edit;
          $tb_laporan->update();

          return back();
      }else{
        return redirect()->back()->with('alert', 'maaf, bulan dan tahun sudah ada!');
      }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // dd($id);
        $tb_laporan = tb_laporan::find($id);
        $tb_laporan->delete();

        DB::statement("DELETE FROM `tb_laporan_detail` WHERE tb_laporan_detail.id_laporan = $id");

        return back();
    }

    public function laporan_update_diajukan($id){

        $tb_laporan = tb_laporan::find($id);
        $tb_laporan->status_laporan = 'diajukan';
        $tb_laporan->tanggal_pengajuan_laporan = Carbon::now();
        $tb_laporan->update();

        DB::statement("UPDATE tb_laporan_detail
          SET tb_laporan_detail.status_laporan_detail = 'diajukan'
          where tb_laporan_detail.id_laporan = '$id'
          and not tb_laporan_detail.status_laporan_detail = 'valid'
          ");

        return redirect('backend_operator_laporan');

    }
}
