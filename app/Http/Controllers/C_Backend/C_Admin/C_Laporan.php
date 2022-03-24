<?php

namespace App\Http\Controllers\C_Backend\C_Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\tb_laporan;

class C_Laporan extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    $filter_data_tahun_admin_session = $request->session()->get('filter_data_tahun_admin');
      $tb_laporan = DB::table('tb_laporan')
                    ->select(DB::raw('*'))
                    ->whereNotIn('status_laporan', ['draft'])
                    ->where(DB::raw('SUBSTRING(bulan_tahun_laporan, 4, 4)'),'=', $filter_data_tahun_admin_session)
                    ->get();

      $tb_laporan_detail = DB::table('tb_laporan_detail')
                    ->select(DB::raw('*'))
                    ->whereNotIn('status_laporan_detail', ['draft'])
                    ->get();

      return view('V_Backend/V_Admin/V_Laporan',[
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
}
