<?php

namespace App\Http\Controllers\C_Backend\C_Pimpinan;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class C_Filter_Data extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter_data_tahun_pimpinan_session = $request->session()->get('filter_data_tahun_pimpinan');
        $tahun_sekarang = date("Y");
        return view('V_Backend.V_pimpinan.V_Filter_Data',[
            'tahun_sekarang'=>$tahun_sekarang,
            'filter_data_tahun_pimpinan_session'=>$filter_data_tahun_pimpinan_session
        ]);

    }

    public function update_session_tahun(Request $request, $tahun_session){
        // echo $tahun_session;
        $request->session()->put('filter_data_tahun_pimpinan', $tahun_session);
        return back();
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
