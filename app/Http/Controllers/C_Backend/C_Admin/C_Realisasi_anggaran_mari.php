<?php

namespace App\Http\Controllers\C_Backend\C_Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class C_Realisasi_anggaran_mari extends Controller
{

  public function index(Request $request)
  {
    $filter_data_tahun_admin_session = $request->session()->get('filter_data_tahun_admin');
    $th_saatini = date('Y');
    $tbl_bulan = DB::table('tb_realisasi_anggaran_mari')
      ->select(DB::raw('tb_realisasi_anggaran_mari.*,
        SUBSTRING(tb_realisasi_anggaran_mari.tanggal_realisasi_anggaran,6,2) as bulan_pecah'))
      ->whereYear('tanggal_realisasi_anggaran', '=', $filter_data_tahun_admin_session)
      ->get();

    $myarray = [];

    foreach ($tbl_bulan as $data) {
      $myarray[(int) $data->bulan_pecah - 1] = $data->nilai_realisasi_anggaran;
    }

    $tb_saldo_mari = DB::table('tb_saldo_mari')
      ->select(DB::raw('tb_saldo_mari.nominal'))
      ->whereYear('tanggal', '=', $filter_data_tahun_admin_session)
      ->get();

    if ($tb_saldo_mari->isEmpty()) {
      // dd('coba');
      $nominal_master = 0;
    } else {
      foreach ($tb_saldo_mari as $tbsaldo_mari) {
        $nominal_master = $tbsaldo_mari->nominal;
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



    $tb_realisasi_anggaran_mari_ambil_tanggal = DB::table('tb_realisasi_anggaran_mari')
      ->select(DB::raw('SUBSTRING(tb_realisasi_anggaran_mari.tanggal_realisasi_anggaran, 6,2) AS bulan_realisasi_anggaran'))
      ->whereYear('tb_realisasi_anggaran_mari.tanggal_realisasi_anggaran', '=', $filter_data_tahun_admin_session)
      ->get();

    $myarray2 = [];

    foreach ($tb_realisasi_anggaran_mari_ambil_tanggal as $data) {
      // $myarray2[] = $data->bulan_perencanaan_anggaran;
      $myarray2[(int) $data->bulan_realisasi_anggaran - 1] = $data->bulan_realisasi_anggaran;
    }

    $ambil_bulan_realisasi_anggaran_form_input = [];
    for ($i = 0; $i < 12; $i++) {
      if (!isset($myarray2[$i])) {
        $ambil_bulan_realisasi_anggaran_form_input[] = "$i";
      } else {
        $ambil_bulan_realisasi_anggaran_form_input[] = "";
      }
    }

    $ambil_bulan_realisasi_anggaran_form_edit = [];
    for ($i = 0; $i < 12; $i++) {
      if (!isset($myarray2[$i])) {
        $ambil_bulan_realisasi_anggaran_form_edit[] = "";
      } else {
        $ambil_bulan_realisasi_anggaran_form_edit[] = $myarray2[$i];
      }
    }







    //grafik anggaran (realisasi anggaran)
    $tbl_bulan_realisasi_persenan = DB::table('tb_realisasi_anggaran_mari')
      ->select(DB::raw('tb_realisasi_anggaran_mari.*,
          SUBSTRING(tb_realisasi_anggaran_mari.tanggal_realisasi_anggaran,6,2) as bulan_pecah'))
      ->whereYear('tanggal_realisasi_anggaran', '=', $filter_data_tahun_admin_session)
      ->get();

    $myarray5 = [];

    foreach ($tbl_bulan_realisasi_persenan as $data) {
      $myarray5[(int) $data->bulan_pecah - 1] = (int) $data->nilai_realisasi_anggaran;
    }

    for ($l = 0; $l < 12; $l++) {
      if (!isset($myarray5[$l])) {
        $nilai_realisasi[] = 0;
      } else {
        $nilai_realisasi[] = $myarray5[$l];
      }
    }


    if ($nilai_realisasi[0] != 0) {
      if ($nominal_master != 0) {
        $nilai_realisasi_anggaran_persenan[] = $nilai_realisasi[0] / $nominal_master * 100; //januari
      } else {
        $nilai_realisasi_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan[] = 0;
    }

    if ($nilai_realisasi[1] != 0) {
      if ($nominal_master != 0) {
        $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0] + $nilai_realisasi[1]) / $nominal_master * 100; //februari
      } else {
        $nilai_realisasi_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan[] = 0;
    }

    if ($nilai_realisasi[2] != 0) {
      if ($nominal_master != 0) {
        $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0] + $nilai_realisasi[1] + $nilai_realisasi[2]) / $nominal_master * 100; //maret
      } else {
        $nilai_realisasi_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan[] = 0;
    }

    if ($nilai_realisasi[3] != 0) {
      if ($nominal_master != 0) {
        $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0] + $nilai_realisasi[1] + $nilai_realisasi[2] + $nilai_realisasi[3]) / $nominal_master * 100; //april
      } else {
        $nilai_realisasi_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan[] = 0;
    }

    if ($nilai_realisasi[4] != 0) {
      if ($nominal_master != 0) {
        $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0] + $nilai_realisasi[1] + $nilai_realisasi[2] + $nilai_realisasi[3] + $nilai_realisasi[4]) / $nominal_master * 100; //mei
      } else {
        $nilai_realisasi_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan[] = 0;
    }

    if ($nilai_realisasi[5] != 0) {
      if ($nominal_master != 0) {
        $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0] + $nilai_realisasi[1] + $nilai_realisasi[2] + $nilai_realisasi[3] + $nilai_realisasi[4] + $nilai_realisasi[5]) / $nominal_master * 100; //juni
      } else {
        $nilai_realisasi_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan[] = 0;
    }

    if ($nilai_realisasi[6] != 0) {
      if ($nominal_master != 0) {
        $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0] + $nilai_realisasi[1] + $nilai_realisasi[2] + $nilai_realisasi[3] + $nilai_realisasi[4] + $nilai_realisasi[5] + $nilai_realisasi[6]) / $nominal_master * 100; //juli
      } else {
        $nilai_realisasi_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan[] = 0;
    }

    if ($nilai_realisasi[7] != 0) {
      if ($nominal_master != 0) {
        $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0] + $nilai_realisasi[1] + $nilai_realisasi[2] + $nilai_realisasi[3] + $nilai_realisasi[4] + $nilai_realisasi[5] + $nilai_realisasi[6] + $nilai_realisasi[7]) / $nominal_master * 100; //agustus
      } else {
        $nilai_realisasi_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan[] = 0;
    }

    if ($nilai_realisasi[8] != 0) {
      if ($nominal_master != 0) {
        $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0] + $nilai_realisasi[1] + $nilai_realisasi[2] + $nilai_realisasi[3] + $nilai_realisasi[4] + $nilai_realisasi[5] + $nilai_realisasi[6] + $nilai_realisasi[7] + $nilai_realisasi[8]) / $nominal_master * 100; //september
      } else {
        $nilai_realisasi_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan[] = 0;
    }

    if ($nilai_realisasi[9] != 0) {
      if ($nominal_master != 0) {
        $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0] + $nilai_realisasi[1] + $nilai_realisasi[2] + $nilai_realisasi[3] + $nilai_realisasi[4] + $nilai_realisasi[5] + $nilai_realisasi[6] + $nilai_realisasi[7] + $nilai_realisasi[8] + $nilai_realisasi[9]) / $nominal_master * 100; //oktober
      } else {
        $nilai_realisasi_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan[] = 0;
    }

    if ($nilai_realisasi[10] != 0) {
      if ($nominal_master != 0) {
        $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0] + $nilai_realisasi[1] + $nilai_realisasi[2] + $nilai_realisasi[3] + $nilai_realisasi[4] + $nilai_realisasi[5] + $nilai_realisasi[6] + $nilai_realisasi[7] + $nilai_realisasi[8] + $nilai_realisasi[9] + $nilai_realisasi[10]) / $nominal_master * 100; //november
      } else {
        $nilai_realisasi_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan[] = 0;
    }

    if ($nilai_realisasi[11] != 0) {
      if ($nominal_master != 0) {
        $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0] + $nilai_realisasi[1] + $nilai_realisasi[2] + $nilai_realisasi[3] + $nilai_realisasi[4] + $nilai_realisasi[5] + $nilai_realisasi[6] + $nilai_realisasi[7] + $nilai_realisasi[8] + $nilai_realisasi[9] + $nilai_realisasi[10] + $nilai_realisasi[11]) / $nominal_master * 100; //desember
      } else {
        $nilai_realisasi_anggaran_persenan[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan[] = 0;
    }



    return view('V_Backend.V_Admin.V_Realisasi_anggaran_mari', compact(
      'nilai_bulan',
      'nominal_master',
      'ambil_bulan_realisasi_anggaran_form_input',
      'ambil_bulan_realisasi_anggaran_form_edit',
      'nilai_realisasi_anggaran_persenan'
    ));
  }

  public function aksi_save_realisasi_anggaran(Request $request)
  {


    $y_saatini = date('Y');
    $filter_data_tahun_admin_session = $request->session()->get('filter_data_tahun_admin');
    $d_saatini = "01";
    $m_saatini = $request->input('tanggal');
    $realisasi = $request->input('realisasi');
    $nilai_perencanaan_anggaran = $request->input('nilai_perencanaan_anggaran');

    if ($nilai_perencanaan_anggaran < $realisasi) {
      $tanggal = $filter_data_tahun_admin_session . "-" . $m_saatini . "-" . $d_saatini;

      DB::table('tb_realisasi_anggaran_mari')->insert([
        'nilai_realisasi_anggaran' => $realisasi,
        'tanggal_realisasi_anggaran' => $tanggal,
      ]);

      return redirect()->back()->with('alert', 'Realisasi Melebihi Perencanaan');
    } else {
      $tanggal = $filter_data_tahun_admin_session . "-" . $m_saatini . "-" . $d_saatini;

      DB::table('tb_realisasi_anggaran_mari')->insert([
        'nilai_realisasi_anggaran' => $realisasi,
        'tanggal_realisasi_anggaran' => $tanggal,
      ]);

      return redirect()->back();
    }
  }

  public function aksi_update_realisasi_anggaran(Request $request)
  {
    $tanggal = $request->input('tanggal_edit');
    $realisasi = $request->input('nilai_perencanaan_realisasi_edit');
    $anggaran = $request->input('nilai_perencanaan_anggaran_edit');

    if ($anggaran < $realisasi) {
      return redirect()->back()->with('alert', 'maaf, realisasi melebihi perencanaan');
    } else {
      DB::table('tb_realisasi_anggaran_mari')
        ->whereMonth('tanggal_realisasi_anggaran', $tanggal)
        ->update([
          'nilai_realisasi_anggaran' => $realisasi,
        ]);

      return redirect()->back();
    }
  }

  public function show_autocomplate(Request $request, $id)
  {
    $filter_data_tahun_admin_session = $request->session()->get('filter_data_tahun_admin');
    $tb_perencanaan = DB::table('tb_perencanaan_anggaran_mari')
      ->select(DB::raw('tb_perencanaan_anggaran_mari.*'))
      ->whereMonth('tb_perencanaan_anggaran_mari.tanggal_perencanaan_anggaran', '=', $id)
      ->whereYear('tb_perencanaan_anggaran_mari.tanggal_perencanaan_anggaran', '=', $filter_data_tahun_admin_session)
      ->get();
    echo json_encode($tb_perencanaan);
  }

  public function show_autocomplate_edit($id)
  {
    $tb = DB::table('tb_perencanaan_anggaran_mari')
      ->select(DB::raw('tb_perencanaan_anggaran_mari.*'))
      ->whereMonth('tb_perencanaan_anggaran_mari.tanggal_perencanaan_anggaran', '=', $id)
      ->get();

    echo json_encode($tb);
  }

  public function show_autocomplate_edit1($id)
  {
    $tb = DB::table('tb_realisasi_anggaran_mari')
      ->select(DB::raw('tb_realisasi_anggaran_mari.*'))
      ->whereMonth('tb_realisasi_anggaran_mari.tanggal_realisasi_anggaran', '=', $id)
      ->get();

    echo json_encode($tb);
  }
}
