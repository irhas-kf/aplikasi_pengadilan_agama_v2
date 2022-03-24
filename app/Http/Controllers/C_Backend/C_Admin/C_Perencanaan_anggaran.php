<?php

namespace App\Http\Controllers\C_Backend\C_Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\CetakPdf;

class C_Perencanaan_anggaran extends Controller
{

  public function index(Request $request)
  {
    $filter_data_tahun_admin_session = $request->session()->get('filter_data_tahun_admin');
    $th_saatini = date('Y');
    $tbl_bulan = DB::table('tb_perencanaan_anggaran')
      ->select(DB::raw('tb_perencanaan_anggaran.*,
        SUBSTRING(tb_perencanaan_anggaran.tanggal_perencanaan_anggaran,6,2) as bulan_pecah'))
      ->whereYear('tanggal_perencanaan_anggaran', '=', $filter_data_tahun_admin_session)
      ->get();

    $myarray = [];

    foreach ($tbl_bulan as $data) {
      $myarray[(int) $data->bulan_pecah - 1] = $data->nilai_perencanaan_anggaran;
    }

    $tb_saldo = DB::table('tb_saldo')
      ->select(DB::raw('tb_saldo.nominal'))
      ->whereYear('tanggal', '=', $th_saatini)
      ->get();

    if ($tb_saldo->isEmpty()) {
      // dd('coba');
      $nominal_master = 0;
    } else {
      foreach ($tb_saldo as $tbsaldo) {
        $nominal_master = $tbsaldo->nominal;
      }
    }

    $nilai_bulan = [];
    for ($i = 0; $i < 12; $i++) {
      if (!isset($myarray[$i])) {
        $nilai_bulan[] = "";
      } else {
        $nilai_bulan[] = $myarray[$i];
      }
    }

    $tb_perencanaan_anggaran_ambil_tanggal = DB::table('tb_perencanaan_anggaran')
      ->select(DB::raw('SUBSTRING(tb_perencanaan_anggaran.tanggal_perencanaan_anggaran, 6,2) AS bulan_perencanaan_anggaran'))
      ->whereYear('tanggal_perencanaan_anggaran', '=', $filter_data_tahun_admin_session)
      ->get();

    $myarray2 = [];

    foreach ($tb_perencanaan_anggaran_ambil_tanggal as $data) {
      // $myarray2[] = $data->bulan_perencanaan_anggaran;
      $myarray2[(int) $data->bulan_perencanaan_anggaran - 1] = $data->bulan_perencanaan_anggaran;
    }

    $ambil_bulan_perencanaan_anggaran_form_input = [];
    for ($i = 0; $i < 12; $i++) {
      if (!isset($myarray2[$i])) {
        $ambil_bulan_perencanaan_anggaran_form_input[] = "$i";
      } else {
        $ambil_bulan_perencanaan_anggaran_form_input[] = "";
      }
    }

    $ambil_bulan_perencanaan_anggaran_form_edit = [];
    for ($i = 0; $i < 12; $i++) {
      if (!isset($myarray2[$i])) {
        $ambil_bulan_perencanaan_anggaran_form_edit[] = "";
      } else {
        $ambil_bulan_perencanaan_anggaran_form_edit[] = $myarray2[$i];
      }
    }





    // grafik anggaran (perencanaan anggaran)
    $tbl_bulan_perencanaan_persenan = DB::table('tb_perencanaan_anggaran')
      ->select(DB::raw('tb_perencanaan_anggaran.*,
           SUBSTRING(tb_perencanaan_anggaran.tanggal_perencanaan_anggaran,6,2) as bulan_pecah'))
      ->whereYear('tanggal_perencanaan_anggaran', '=', $filter_data_tahun_admin_session)
      ->get();

    $myarray3 = [];

    foreach ($tbl_bulan_perencanaan_persenan as $data) {
      $myarray3[(int) $data->bulan_pecah - 1] = $data->nilai_perencanaan_anggaran;
    }


    $nilai_perencanaan = [];

    for ($l = 0; $l < 12; $l++) {
      if (!isset($myarray3[$l])) {
        $nilai_perencanaan[] = 0;
      } else {
        $nilai_perencanaan[] = $myarray3[$l];
      }
    }

    $nilai_perencanaan_anggaran_persenan = [];

    if ($nilai_perencanaan[0] != 0) {
      if ($nominal_master != 0) {
        $nilai_perencanaan_anggaran_persenan[] = $nilai_perencanaan[0] / $nominal_master * 100; //januari
      } else {
        $nilai_perencanaan_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan[] = 0;
    }

    if ($nilai_perencanaan[1] != 0) {
      if ($nominal_master != 0) {
        $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0] + $nilai_perencanaan[1]) / $nominal_master * 100; //februari
      } else {
        $nilai_perencanaan_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan[] = 0;
    }

    if ($nilai_perencanaan[2] != 0) {
      if ($nominal_master != 0) {
        $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0] + $nilai_perencanaan[1] + $nilai_perencanaan[2]) / $nominal_master * 100; //maret
      } else {
        $nilai_perencanaan_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan[] = 0;
    }

    if ($nilai_perencanaan[3] != 0) {
      if ($nominal_master != 0) {
        $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0] + $nilai_perencanaan[1] + $nilai_perencanaan[2] + $nilai_perencanaan[3]) / $nominal_master * 100; //april
      } else {
        $nilai_perencanaan_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan[] = 0;
    }

    if ($nilai_perencanaan[4] != 0) {
      if ($nominal_master != 0) {
        $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0] + $nilai_perencanaan[1] + $nilai_perencanaan[2] + $nilai_perencanaan[3] + $nilai_perencanaan[4]) / $nominal_master * 100; //mei
      } else {
        $nilai_perencanaan_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan[] = 0;
    }

    if ($nilai_perencanaan[5] != 0) {
      if ($nominal_master != 0) {
        $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0] + $nilai_perencanaan[1] + $nilai_perencanaan[2] + $nilai_perencanaan[3] + $nilai_perencanaan[4] + $nilai_perencanaan[5]) / $nominal_master * 100; //juni
      } else {
        $nilai_perencanaan_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan[] = 0;
    }

    if ($nilai_perencanaan[6] != 0) {
      if ($nominal_master != 0) {
        $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0] + $nilai_perencanaan[1] + $nilai_perencanaan[2] + $nilai_perencanaan[3] + $nilai_perencanaan[4] + $nilai_perencanaan[5] + $nilai_perencanaan[6]) / $nominal_master * 100; //juli
      } else {
        $nilai_perencanaan_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan[] = 0;
    }

    if ($nilai_perencanaan[7] != 0) {
      if ($nominal_master != 0) {
        $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0] + $nilai_perencanaan[1] + $nilai_perencanaan[2] + $nilai_perencanaan[3] + $nilai_perencanaan[4] + $nilai_perencanaan[5] + $nilai_perencanaan[6] + $nilai_perencanaan[7]) / $nominal_master * 100; //agustus
      } else {
        $nilai_perencanaan_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan[] = 0;
    }

    if ($nilai_perencanaan[8] != 0) {
      if ($nominal_master != 0) {
        $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0] + $nilai_perencanaan[1] + $nilai_perencanaan[2] + $nilai_perencanaan[3] + $nilai_perencanaan[4] + $nilai_perencanaan[5] + $nilai_perencanaan[6] + $nilai_perencanaan[7] + $nilai_perencanaan[8]) / $nominal_master * 100; //september
      } else {
        $nilai_perencanaan_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan[] = 0;
    }

    if ($nilai_perencanaan[9] != 0) {
      if ($nominal_master != 0) {
        $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0] + $nilai_perencanaan[1] + $nilai_perencanaan[2] + $nilai_perencanaan[3] + $nilai_perencanaan[4] + $nilai_perencanaan[5] + $nilai_perencanaan[6] + $nilai_perencanaan[7] + $nilai_perencanaan[8] + $nilai_perencanaan[9]) / $nominal_master * 100; //oktober
      } else {
        $nilai_perencanaan_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan[] = 0;
    }

    if ($nilai_perencanaan[10] != 0) {
      if ($nominal_master != 0) {
        $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0] + $nilai_perencanaan[1] + $nilai_perencanaan[2] + $nilai_perencanaan[3] + $nilai_perencanaan[4] + $nilai_perencanaan[5] + $nilai_perencanaan[6] + $nilai_perencanaan[7] + $nilai_perencanaan[8] + $nilai_perencanaan[9] + $nilai_perencanaan[10]) / $nominal_master * 100; //november
      } else {
        $nilai_perencanaan_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan[] = 0;
    }

    if ($nilai_perencanaan[11] != 0) {
      if ($nominal_master != 0) {
        $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0] + $nilai_perencanaan[1] + $nilai_perencanaan[2] + $nilai_perencanaan[3] + $nilai_perencanaan[4] + $nilai_perencanaan[5] + $nilai_perencanaan[6] + $nilai_perencanaan[7] + $nilai_perencanaan[8] + $nilai_perencanaan[9] + $nilai_perencanaan[10] + $nilai_perencanaan[11]) / $nominal_master * 100; //desember
      } else {
        $nilai_perencanaan_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan[] = 0;
    }


    return view('V_Backend.V_Admin.V_Perencanaan_anggaran', compact(
      'nilai_bulan',
      'nominal_master',
      'ambil_bulan_perencanaan_anggaran_form_input',
      'ambil_bulan_perencanaan_anggaran_form_edit',
      'nilai_perencanaan_anggaran_persenan'
    ));
  }

  public function aksi_save_perencanaan_anggaran(Request $request)
  {
    $y_saatini = date('Y');
    $filter_data_tahun_admin_session = $request->session()->get('filter_data_tahun_admin');
    $m_saatini = $request->input('tanggal');
    $perencanaan = $request->input('perencanaan');

    $tanggal = $filter_data_tahun_admin_session . "-" . $m_saatini . "-" . "01";

    DB::table('tb_perencanaan_anggaran')->insert([
      'nilai_perencanaan_anggaran' => $perencanaan,
      'tanggal_perencanaan_anggaran' => $tanggal,
    ]);

    $tb_saldo = DB::table('tb_saldo')
      ->select(DB::raw('tb_saldo.*'))
      ->whereYear('tanggal', '=', $filter_data_tahun_admin_session)
      ->get();

    foreach ($tb_saldo as $data) {
      $sisa_saldo = $data->sisa;
      $tergunakan = $data->tergunakan;
    }

    $rumus_kurang_saldo = $sisa_saldo - $perencanaan;
    $rumus_tergunakan_saldo = $tergunakan + $perencanaan;

    DB::table('tb_saldo')
      ->whereYear('tanggal', $filter_data_tahun_admin_session)
      ->update([
        'sisa' => $rumus_kurang_saldo,
        'tergunakan' => $rumus_tergunakan_saldo,
      ]);

    return redirect()->back();
  }

  public function show_autocomplate(Request $request, $id)
  {

    $tb_perencanaan = DB::table('tb_perencanaan_anggaran')
      ->select(DB::raw('tb_perencanaan_anggaran.*'))
      ->whereMonth('tb_perencanaan_anggaran.tanggal_perencanaan_anggaran', '=', $id)
      ->get();

    echo json_encode($tb_perencanaan);
  }

  public function aksi_update_perencanaan_anggaran(Request $request)
  {
    $y_saatini = date('Y');
    $filter_data_tahun_admin_session = $request->session()->get('filter_data_tahun_admin');
    $id_perencanaan = $request->input('id_perencanaan_anggaran');
    $nilai_perencanaan_anggaran = $request->input('nilai_perencanaan_anggaran');

    DB::table('tb_perencanaan_anggaran')
      ->where('id_perencanaan_anggaran', $id_perencanaan)
      ->update([
        'nilai_perencanaan_anggaran' => $nilai_perencanaan_anggaran,
      ]);

    $tb_perencanaan_anggaran = DB::table('tb_perencanaan_anggaran')
      ->select(DB::raw('SUM(tb_perencanaan_anggaran.nilai_perencanaan_anggaran) AS total_nominal'))
      ->whereYear('tanggal_perencanaan_anggaran', '=', $filter_data_tahun_admin_session)
      ->get();

    foreach ($tb_perencanaan_anggaran as $tbperencanaan) {
      $sum_total_nominal = $tbperencanaan->total_nominal;
    }

    $tb_saldo = DB::table('tb_saldo')
      ->select(DB::raw('tb_saldo.*'))
      ->whereYear('tanggal', '=', $filter_data_tahun_admin_session)
      ->get();

    foreach ($tb_saldo as $tbsaldo) {
      $nominal_master = $tbsaldo->nominal;
      $tergunakan = $tbsaldo->tergunakan;
    }

    $rumus_kurang_saldo = $nominal_master - $sum_total_nominal;
    $rumus_tergunakan_saldo = $nominal_master - $rumus_kurang_saldo;

    DB::table('tb_saldo')
      ->whereYear('tanggal', $filter_data_tahun_admin_session)
      ->update([
        'sisa' => $rumus_kurang_saldo,
        'tergunakan' => $rumus_tergunakan_saldo,
      ]);
    return redirect()->back();
  }
}
