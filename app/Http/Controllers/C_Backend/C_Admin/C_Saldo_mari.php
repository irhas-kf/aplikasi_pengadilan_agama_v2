<?php

namespace App\Http\Controllers\C_Backend\C_Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class C_Saldo_mari extends Controller
{

  public function index(Request $request)
  {

    $th_saatini = date('Y');
    $filter_data_tahun_admin_session = $request->session()->get('filter_data_tahun_admin');

    $saldo = DB::table('tb_saldo_mari')
    ->whereYear('tanggal', '=', $filter_data_tahun_admin_session )
    ->limit(1)
    ->get();

    return view('V_Backend.V_Admin.V_Saldo_mari',compact('saldo'));
  }

  public function save_saldo(Request $request){

    $filter_data_tahun_admin_session = $request->session()->get('filter_data_tahun_admin');
    $saldo = $request->input('saldo');

     DB::table('tb_saldo_mari')->insert([
        'nominal' => $saldo,
        'tergunakan' => 0,
        'sisa' => $saldo,
        'tanggal' => $filter_data_tahun_admin_session.'-'.'01'.'-'.'01',
      ]);

     return redirect()->back();
  }

  public function show_saldo($id)
  {
    $tb_saldo_mari = DB::table('tb_saldo_mari')
    ->select(DB::raw('tb_saldo_mari.*'))
    ->where('tb_saldo_mari.id_saldo','=',$id)
    ->get();

    echo json_encode($tb_saldo_mari);
  }

  public function update_saldo(Request $request)
  {
    $filter_data_tahun_admin_session = $request->session()->get('filter_data_tahun_admin');
    $id_saldo = $request->input('id_saldo');
    $nominal = $request->input('nominal');

    //rumus saldo tergunakan
    $tb_saldo_mari = DB::table('tb_saldo_mari')
    ->select(DB::raw('tb_saldo_mari.tergunakan'))
    ->where('tb_saldo_mari.id_saldo','=',$id_saldo)
    ->get();

    foreach ($tb_saldo_mari as $tbsaldo_tergunakan) {
      $tbsaldo_tergunakan_result = $tbsaldo_tergunakan->tergunakan;
    }

    $rumus_sisa = $nominal-$tbsaldo_tergunakan_result;

    DB::table('tb_saldo_mari')
    ->where('id_saldo',$id_saldo)
    ->update([
       'nominal' => $nominal,
       'sisa' => $rumus_sisa,
     ]);
     //dd($id_saldo);
    return redirect()->back();
  }

  public function destroy($id)
  {
    $tb_saldo_mari = DB::table('tb_saldo_mari')
    ->where('tb_saldo_mari.id_saldo','=',$id)
    ->delete();

      return redirect()->back();
  }
}
