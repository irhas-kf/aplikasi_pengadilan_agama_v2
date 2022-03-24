<?php

namespace App\Http\Controllers\C_Backend\C_Operator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use DB;
use App\tb_laporan_detail;

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
                          ->get();

      $laporan_yang_sudah_dimasukan = [];
      foreach ($tb_laporan_detail as $data) {
        $laporan_yang_sudah_dimasukan[] = $data->id_nama_laporan;
      }


      $laporan_yang_sudah_dimasukan_form = DB::table('tb_nama_laporan')
                          ->select(DB::raw('tb_nama_laporan.*'))
                          ->whereNotIn('tb_nama_laporan.id_nama_laporan', $laporan_yang_sudah_dimasukan)
                          ->get();

      $tb_laporan = DB::table('tb_laporan')
                          ->select(DB::raw('tb_laporan.*'))
                          ->where('tb_laporan.id_laporan', '=', $id)
                          ->get();

      $ambil_status_laporan = '';
      foreach ($tb_laporan as $data2) {
        $ambil_status_laporan = $data2->status_laporan;
      }

      $ambil_laporan_detail_status_valid = DB::table('tb_laporan_detail')
                          ->select(DB::raw('tb_laporan_detail.*'))
                          ->where('tb_laporan_detail.id_laporan', '=', $id)
                          ->where('tb_laporan_detail.status_laporan_detail', '=', 'valid')
                          ->get();

      $ambil_laporan_detail_status_draft = DB::table('tb_laporan_detail')
                          ->select(DB::raw('tb_laporan_detail.*'))
                          ->where('tb_laporan_detail.id_laporan', '=', $id)
                          ->where('tb_laporan_detail.status_laporan_detail', '=', 'draft')
                          ->get();

      // dd($ambil_laporan_detail_status_valid->count());

      // dd($ambil_status_laporan);

      // dd($tb_laporan_detail);

      // dd($id);

      return view('V_Backend/V_Operator/V_Laporan_Detail',[
        'tb_laporan_detail'=>$tb_laporan_detail,
        'laporan_yang_sudah_dimasukan_form'=>$laporan_yang_sudah_dimasukan_form,
        'id_laporan'=>$id,
        'ambil_status_laporan'=>$ambil_status_laporan,
        'ambil_laporan_detail_status_valid'=>$ambil_laporan_detail_status_valid,
        'ambil_laporan_detail_status_draft'=>$ambil_laporan_detail_status_draft
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


      $file = $request->file('file_laporan');
      $filepath = time() .uniqid(). '.' . $file->getClientOriginalExtension();
      $filename = $file->getClientOriginalName();
      $destinationPath = public_path() . '/File_Laporan/';
      $file->move($destinationPath, $filepath);


      $tb_laporan = new tb_laporan_detail;
      $tb_laporan->id_laporan = $request['id_laporan'];
      $tb_laporan->id_nama_laporan = $request['id_nama_laporan'];
      $tb_laporan->file_laporan = $filepath;
      $tb_laporan->ekstensi_laporan = $file->getClientOriginalExtension();
      $tb_laporan->status_laporan_detail = 'draft';
      $tb_laporan->save();

      return back();
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
      // $tb_laporan_detail = DB::table('tb_laporan_detail')
      // ->select(DB::raw('tb_laporan_detail.*, tb_nama_laporan.*'))
      // ->where('tb_laporan_detail.id_laporan_detail','=',$id)
      // ->join('tb_nama_laporan', 'tb_nama_laporan.id_nama_laporan', '=', 'tb_laporan_detail.id_nama_laporan')
      // ->get();

      $tb_laporan_detail = DB::table('tb_laporan_detail')
      ->select(DB::raw('tb_laporan_detail.*, tb_nama_laporan.*, tb_laporan_detail_revisi.catatan_revisi'))
      ->where('tb_laporan_detail.id_laporan_detail','=',$id)
      ->join('tb_nama_laporan', 'tb_nama_laporan.id_nama_laporan', '=', 'tb_laporan_detail.id_nama_laporan')
      ->leftJoin('tb_laporan_detail_revisi', 'tb_laporan_detail_revisi.id_laporan_detail', '=', 'tb_laporan_detail.id_laporan_detail')
      ->get();

      echo json_encode($tb_laporan_detail);
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

      //delete file pada direktori File Laporan
      $tb_laporan_detail = DB::table('tb_laporan_detail')
      ->select(DB::raw('tb_laporan_detail.*'))
      ->where('tb_laporan_detail.id_laporan_detail','=',$request['id_laporan_detail_edit'])
      ->get();

      $file_laporan = '';
      foreach ($tb_laporan_detail as $data) {
        $file_laporan = $data->file_laporan;
      }

      $file= public_path(). "/File_Laporan/".$file_laporan;
      File::delete($file);

      //tambah file pada direktori FIle Laporan
      $file = $request->file('file_laporan_edit');
      $filepath = time() .uniqid(). '.' . $file->getClientOriginalExtension();
      $filename = $file->getClientOriginalName();
      $destinationPath = public_path() . '/File_Laporan/';
      $file->move($destinationPath, $filepath);

      $tb_laporan_detail = tb_laporan_detail::find($request['id_laporan_detail_edit']);
      $tb_laporan_detail->file_laporan = $filepath;
      $tb_laporan_detail->update();

      return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

      $tb_laporan_detail = DB::table('tb_laporan_detail')
      ->select(DB::raw('tb_laporan_detail.*'))
      ->where('tb_laporan_detail.id_laporan_detail','=',$id)
      ->get();

      $file_laporan = '';
      foreach ($tb_laporan_detail as $data) {
        $file_laporan = $data->file_laporan;
      }

      $file= public_path(). "/File_Laporan/".$file_laporan;
      File::delete($file);

      $tb_laporan_detail = tb_laporan_detail::find($id);
      $tb_laporan_detail->delete();

      return back();
    }

    public function download_file_laporan_pdf($nama_file)
    {
      //PDF file is stored under project/public/download/info.pdf
      $file= public_path(). "/File_Laporan/".$nama_file;

      // $headers = array(
      //           'Content-Type: application/pdf',
      //         );

      // return Response::download($file, $nama_file, $headers);

      return Response::make(file_get_contents($file), 200, [

        'Content-Type'=>'application/pdf',

        'Content-Type'=>'application/xlsx',

        'Content-Disposition' => 'inline; filename="'.$nama_file.'"'

      ]);
    }


}
