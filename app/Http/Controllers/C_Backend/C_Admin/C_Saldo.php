<?php

namespace App\Http\Controllers\C_Backend\C_Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class C_Saldo extends Controller
{

  public function index(Request $request)
  {
    $filter_data_tahun_admin_session = $request->session()->get('filter_data_tahun_admin');
    $th_saatini = date('Y');

    $saldo = DB::table('tb_saldo')
    ->whereYear('tanggal', '=', $filter_data_tahun_admin_session )
    ->limit(1)
    ->get();

    return view('V_Backend.V_Admin.V_Saldo',compact('saldo'));
  }

  public function save_saldo(Request $request){

    $filter_data_tahun_admin_session = $request->session()->get('filter_data_tahun_admin');
    $saldo = $request->input('saldo');

     DB::table('tb_saldo')->insert([
        'nominal' => $saldo,
        'tergunakan' => 0,
        'sisa' => $saldo,
        'tanggal' => $filter_data_tahun_admin_session.'-'.'01'.'-'.'01',
      ]);

     return redirect()->back();
  }

  public function show_saldo($id)
  {
    $tb_saldo = DB::table('tb_saldo')
    ->select(DB::raw('tb_saldo.*'))
    ->where('tb_saldo.id_saldo','=',$id)
    ->get();

    echo json_encode($tb_saldo);
  }

  public function update_saldo(Request $request)
  {
    $id_saldo = $request->input('id_saldo');
    $nominal = $request->input('nominal');

    //rumus saldo tergunakan
    $tb_saldo = DB::table('tb_saldo')
    ->select(DB::raw('tb_saldo.tergunakan'))
    ->where('tb_saldo.id_saldo','=',$id_saldo)
    ->get();

    foreach ($tb_saldo as $tbsaldo_tergunakan) {
      $tbsaldo_tergunakan_result = $tbsaldo_tergunakan->tergunakan;
    }

    $rumus_sisa = $nominal-$tbsaldo_tergunakan_result;

    DB::table('tb_saldo')
    ->where('id_saldo',$id_saldo)
    ->update([
       'nominal' => $nominal,
       'sisa' => $rumus_sisa,
     ]);

    return redirect()->back();
  }

  public function destroy($id)
  {
    $tb_saldo = DB::table('tb_saldo')
    ->where('tb_saldo.id_saldo','=',$id)
    ->delete();

      return redirect()->back();
  }
}
