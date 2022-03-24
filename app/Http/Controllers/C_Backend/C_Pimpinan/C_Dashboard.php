<?php

namespace App\Http\Controllers\C_Backend\C_Pimpinan;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Response;
use File;

class C_Dashboard extends Controller
{
  public function index(Request $request)
  {
    $filter_data_tahun_pimpinan_session = $request->session()->get('filter_data_tahun_pimpinan');
    // $filter_data_tahun_pimpinan_session = date('Y');
    //laporan pp39
    $tb_laporan_detail_pp39 = DB::select("SELECT `tb_laporan_detail`.file_laporan, SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 1,2) AS bulan_pecah
    FROM tb_laporan_detail
    JOIN tb_laporan ON `tb_laporan`.`id_laporan` = `tb_laporan_detail`.`id_laporan`
    WHERE SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 4,4) = '$filter_data_tahun_pimpinan_session'
    AND tb_laporan_detail.`status_laporan_detail` = 'valid'
    AND `tb_laporan_detail`.`id_nama_laporan` = '1'");

    $myarray_pp39 = [];
    foreach ($tb_laporan_detail_pp39 as $data) {
      $myarray_pp39[(int) $data->bulan_pecah - 1] = $data->file_laporan;
    }

    $ambil_tb_laporan_detail_pp39_pdf = [];
    for ($i = 0; $i < 12; $i++) {
      if (!isset($myarray_pp39[$i])) {
        $ambil_tb_laporan_detail_pp39_pdf[] = "";
      } else {
        $ambil_tb_laporan_detail_pp39_pdf[] = $myarray_pp39[$i];
      }
    }


    //laporan perkara
    $tb_laporan_detail_perkara = DB::select("SELECT `tb_laporan_detail`.file_laporan, SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 1,2) AS bulan_pecah
    FROM tb_laporan_detail
    JOIN tb_laporan ON `tb_laporan`.`id_laporan` = `tb_laporan_detail`.`id_laporan`
    WHERE SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 4,4) = '$filter_data_tahun_pimpinan_session'
    AND tb_laporan_detail.`status_laporan_detail` = 'valid'
    AND `tb_laporan_detail`.`id_nama_laporan` = '2'");

    $myarray_perkara = [];
    foreach ($tb_laporan_detail_perkara as $data) {
      $myarray_perkara[(int) $data->bulan_pecah - 1] = $data->file_laporan;
    }

    $ambil_tb_laporan_detail_perkara_pdf = [];
    for ($i = 0; $i < 12; $i++) {
      if (!isset($myarray_perkara[$i])) {
        $ambil_tb_laporan_detail_perkara_pdf[] = "";
      } else {
        $ambil_tb_laporan_detail_perkara_pdf[] = $myarray_perkara[$i];
      }
    }


    //laporan lpj01
    $tb_laporan_detail_lpj01 = DB::select("SELECT `tb_laporan_detail`.file_laporan, SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 1,2) AS bulan_pecah
    FROM tb_laporan_detail
    JOIN tb_laporan ON `tb_laporan`.`id_laporan` = `tb_laporan_detail`.`id_laporan`
    WHERE SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 4,4) = '$filter_data_tahun_pimpinan_session'
    AND tb_laporan_detail.`status_laporan_detail` = 'valid'
    AND `tb_laporan_detail`.`id_nama_laporan` = '3'");

    $myarray_lpj01 = [];
    foreach ($tb_laporan_detail_lpj01 as $data) {
      $myarray_lpj01[(int) $data->bulan_pecah - 1] = $data->file_laporan;
    }

    $ambil_tb_laporan_detail_lpj01_pdf = [];
    for ($i = 0; $i < 12; $i++) {
      if (!isset($myarray_lpj01[$i])) {
        $ambil_tb_laporan_detail_lpj01_pdf[] = "";
      } else {
        $ambil_tb_laporan_detail_lpj01_pdf[] = $myarray_lpj01[$i];
      }
    }



    //laporan lpj04
    $tb_laporan_detail_lpj04 = DB::select("SELECT `tb_laporan_detail`.file_laporan, SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 1,2) AS bulan_pecah
    FROM tb_laporan_detail
    JOIN tb_laporan ON `tb_laporan`.`id_laporan` = `tb_laporan_detail`.`id_laporan`
    WHERE SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 4,4) = '$filter_data_tahun_pimpinan_session'
    AND tb_laporan_detail.`status_laporan_detail` = 'valid'
    AND `tb_laporan_detail`.`id_nama_laporan` = '4'");

    $myarray_lpj04 = [];
    foreach ($tb_laporan_detail_lpj04 as $data) {
      $myarray_lpj04[(int) $data->bulan_pecah - 1] = $data->file_laporan;
    }

    $ambil_tb_laporan_detail_lpj04_pdf = [];
    for ($i = 0; $i < 12; $i++) {
      if (!isset($myarray_lpj04[$i])) {
        $ambil_tb_laporan_detail_lpj04_pdf[] = "";
      } else {
        $ambil_tb_laporan_detail_lpj04_pdf[] = $myarray_lpj04[$i];
      }
    }




    $tb_laporan_ambil_jumlah_laporan_per_bulan_untuk_grafik = DB::select("SELECT COUNT(`tb_laporan_detail`.file_laporan) as jumlah_laporan_per_bulan, SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 1,2) as bulan_pecah
    FROM tb_laporan_detail
    JOIN tb_laporan ON `tb_laporan`.`id_laporan` = `tb_laporan_detail`.`id_laporan`
    WHERE SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 4,4) = '$filter_data_tahun_pimpinan_session'
    AND tb_laporan_detail.`status_laporan_detail` = 'valid'
    GROUP BY SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 1,2)");

    $myarray_ambil_jumlah_laporan_per_bulan_untuk_grafik = [];
    foreach ($tb_laporan_ambil_jumlah_laporan_per_bulan_untuk_grafik as $data) {
      $myarray_ambil_jumlah_laporan_per_bulan_untuk_grafik[(int) $data->bulan_pecah - 1] = $data->jumlah_laporan_per_bulan;
    }

    $ambil_jumlah_laporan_per_bulan_untuk_grafik = [];
    for ($i = 0; $i < 12; $i++) {
      if (!isset($myarray_ambil_jumlah_laporan_per_bulan_untuk_grafik[$i])) {
        $ambil_jumlah_laporan_per_bulan_untuk_grafik[] = 0;
      } else {
        $ambil_jumlah_laporan_per_bulan_untuk_grafik[] = $myarray_ambil_jumlah_laporan_per_bulan_untuk_grafik[$i];
      }
    }

    // dd($ambil_jumlah_laporan_per_bulan_untuk_grafik);

    //anggaran dan realisasi dipa mari
    $th_saatini = date('Y');

    $tb_saldo = DB::table('tb_saldo')
      ->select(DB::raw('tb_saldo.nominal'))
      ->whereYear('tanggal', '=', $filter_data_tahun_pimpinan_session)
      ->get();

    if ($tb_saldo->isEmpty()) {
      // dd('coba');
      $nominal_master = 0;
    } else {
      foreach ($tb_saldo as $tbsaldo) {
        $nominal_master = $tbsaldo->nominal;
      }
    }

    $tbl_bulan_perencanaan = DB::table('tb_perencanaan_anggaran')
      ->select(DB::raw('tb_perencanaan_anggaran.*,
        SUBSTRING(tb_perencanaan_anggaran.tanggal_perencanaan_anggaran,6,2) as bulan_pecah'))
      ->whereYear('tanggal_perencanaan_anggaran', '=', $filter_data_tahun_pimpinan_session)
      ->get();

    $myarray = [];

    foreach ($tbl_bulan_perencanaan as $data) {
      $myarray[(int) $data->bulan_pecah - 1] = $data->nilai_perencanaan_anggaran;
    }



    $nilai_perencanaan_anggaran = [];
    for ($i = 0; $i < 12; $i++) {
      if (!isset($myarray[$i])) {
        $nilai_perencanaan_anggaran[] = "0";
      } else {
        $nilai_perencanaan_anggaran[] = $myarray[$i];
      }
    }

    $tbl_bulan_realisasi = DB::table('tb_realisasi_anggaran')
      ->select(DB::raw('tb_realisasi_anggaran.*,
         SUBSTRING(tb_realisasi_anggaran.tanggal_realisasi_anggaran,6,2) as bulan_pecah'))
      ->whereYear('tb_realisasi_anggaran.tanggal_realisasi_anggaran', '=', $filter_data_tahun_pimpinan_session)
      ->get();

    $myarray2 = [];

    foreach ($tbl_bulan_realisasi as $data) {
      $myarray2[(int) $data->bulan_pecah - 1] = $data->nilai_realisasi_anggaran;
    }

    $nilai_realisasi_anggaran = [];
    for ($i = 0; $i < 12; $i++) {
      if (!isset($myarray2[$i])) {
        $nilai_realisasi_anggaran[] = "0";
      } else {
        $nilai_realisasi_anggaran[] = $myarray2[$i];
      }
    }


    //grafik anggaran (perencanaan anggaran)
    $tbl_bulan_perencanaan_persenan = DB::table('tb_perencanaan_anggaran')
      ->select(DB::raw('tb_perencanaan_anggaran.*,
            SUBSTRING(tb_perencanaan_anggaran.tanggal_perencanaan_anggaran,6,2) as bulan_pecah'))
      ->whereYear('tanggal_perencanaan_anggaran', '=', $filter_data_tahun_pimpinan_session)
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



    //grafik anggaran (realisasi anggaran)
    $tbl_bulan_realisasi_persenan = DB::table('tb_realisasi_anggaran')
      ->select(DB::raw('tb_realisasi_anggaran.*,
             SUBSTRING(tb_realisasi_anggaran.tanggal_realisasi_anggaran,6,2) as bulan_pecah'))
      ->whereYear('tanggal_realisasi_anggaran', '=', $filter_data_tahun_pimpinan_session)
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

    // dd($nilai_realisasi_anggaran_persenan);

    //anggaran dan realisasi dipa mari
    $th_saatini = date('Y');

    $tb_saldo_mari = DB::table('tb_saldo_mari')
      ->select(DB::raw('tb_saldo_mari.nominal'))
      ->whereYear('tanggal', '=', $filter_data_tahun_pimpinan_session)
      ->get();

    if ($tb_saldo_mari->isEmpty()) {
      // dd('coba');
      $nominal_master_mari = 0;
    } else {
      foreach ($tb_saldo_mari as $tbsaldo_mari) {
        $nominal_master_mari = $tbsaldo_mari->nominal;
      }
    }



    // dd($nominal_master_mari);

    $tbl_bulan_perencanaan_mari = DB::table('tb_perencanaan_anggaran_mari')
      ->select(DB::raw('tb_perencanaan_anggaran_mari.*,
        SUBSTRING(tb_perencanaan_anggaran_mari.tanggal_perencanaan_anggaran,6,2) as bulan_pecah'))
      ->whereYear('tanggal_perencanaan_anggaran', '=', $filter_data_tahun_pimpinan_session)
      ->get();

    $myarray_mari = [];

    foreach ($tbl_bulan_perencanaan_mari as $data_mari) {
      $myarray_mari[(int) $data_mari->bulan_pecah - 1] = $data_mari->nilai_perencanaan_anggaran;
    }



    $nilai_perencanaan_anggaran_mari = [];
    for ($i = 0; $i < 12; $i++) {
      if (!isset($myarray_mari[$i])) {
        $nilai_perencanaan_anggaran_mari[] = "0";
      } else {
        $nilai_perencanaan_anggaran_mari[] = $myarray_mari[$i];
      }
    }

    $tbl_bulan_realisasi_mari = DB::table('tb_realisasi_anggaran_mari')
      ->select(DB::raw('tb_realisasi_anggaran_mari.*,
         SUBSTRING(tb_realisasi_anggaran_mari.tanggal_realisasi_anggaran,6,2) as bulan_pecah'))
      ->whereYear('tb_realisasi_anggaran_mari.tanggal_realisasi_anggaran', '=', $filter_data_tahun_pimpinan_session)
      ->get();

    $myarray2_mari = [];

    foreach ($tbl_bulan_realisasi_mari as $data_mari) {
      $myarray2_mari[(int) $data_mari->bulan_pecah - 1] = $data_mari->nilai_realisasi_anggaran;
    }

    $nilai_realisasi_anggaran_mari = [];
    for ($i = 0; $i < 12; $i++) {
      if (!isset($myarray2_mari[$i])) {
        $nilai_realisasi_anggaran_mari[] = "0";
      } else {
        $nilai_realisasi_anggaran_mari[] = $myarray2_mari[$i];
      }
    }


    //grafik anggaran (perencanaan anggaran)
    $tbl_bulan_perencanaan_persenan_mari = DB::table('tb_perencanaan_anggaran_mari')
      ->select(DB::raw('tb_perencanaan_anggaran_mari.*,
            SUBSTRING(tb_perencanaan_anggaran_mari.tanggal_perencanaan_anggaran,6,2) as bulan_pecah'))
      ->whereYear('tanggal_perencanaan_anggaran', '=', $filter_data_tahun_pimpinan_session)
      ->get();

    $myarray3_mari = [];

    foreach ($tbl_bulan_perencanaan_persenan_mari as $data_mari) {
      $myarray3_mari[(int) $data_mari->bulan_pecah - 1] = $data_mari->nilai_perencanaan_anggaran;
    }


    $nilai_perencanaan_mari = [];

    for ($m = 0; $m < 12; $m++) {
      if (!isset($myarray3_mari[$m])) {
        $nilai_perencanaan_mari[] = 0;
      } else {
        $nilai_perencanaan_mari[] = $myarray3_mari[$m];
      }
    }

    $nilai_perencanaan_anggaran_persenan_mari = [];

    // dd($nilai_perencanaan_mari[9]);

    if ($nilai_perencanaan_mari[0] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_perencanaan_anggaran_persenan_mari[] = $nilai_perencanaan_mari[0] / $nominal_master_mari * 100; //januari
      } else {
        $nilai_perencanaan_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_perencanaan_mari[1] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_perencanaan_anggaran_persenan_mari[] = ($nilai_perencanaan_mari[0] + $nilai_perencanaan_mari[1]) / $nominal_master_mari * 100; //februari
      } else {
        $nilai_perencanaan_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_perencanaan_mari[2] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_perencanaan_anggaran_persenan_mari[] = ($nilai_perencanaan_mari[0] + $nilai_perencanaan_mari[1] + $nilai_perencanaan_mari[2]) / $nominal_master_mari * 100; //maret
      } else {
        $nilai_perencanaan_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_perencanaan_mari[3] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_perencanaan_anggaran_persenan_mari[] = ($nilai_perencanaan_mari[0] + $nilai_perencanaan_mari[1] + $nilai_perencanaan_mari[2] + $nilai_perencanaan_mari[3]) / $nominal_master_mari * 100; //april
      } else {
        $nilai_perencanaan_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_perencanaan_mari[4] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_perencanaan_anggaran_persenan_mari[] = ($nilai_perencanaan_mari[0] + $nilai_perencanaan_mari[1] + $nilai_perencanaan_mari[2] + $nilai_perencanaan_mari[3] + $nilai_perencanaan_mari[4]) / $nominal_master_mari * 100; //mei
      } else {
        $nilai_perencanaan_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_perencanaan_mari[5] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_perencanaan_anggaran_persenan_mari[] = ($nilai_perencanaan_mari[0] + $nilai_perencanaan_mari[1] + $nilai_perencanaan_mari[2] + $nilai_perencanaan_mari[3] + $nilai_perencanaan_mari[4] + $nilai_perencanaan_mari[5]) / $nominal_master_mari * 100; //juni
      } else {
        $nilai_perencanaan_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_perencanaan_mari[6] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_perencanaan_anggaran_persenan_mari[] = ($nilai_perencanaan_mari[0] + $nilai_perencanaan_mari[1] + $nilai_perencanaan_mari[2] + $nilai_perencanaan_mari[3] + $nilai_perencanaan_mari[4] + $nilai_perencanaan_mari[5] + $nilai_perencanaan_mari[6]) / $nominal_master_mari * 100; //juli
      } else {
        $nilai_perencanaan_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_perencanaan_mari[7] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_perencanaan_anggaran_persenan_mari[] = ($nilai_perencanaan_mari[0] + $nilai_perencanaan_mari[1] + $nilai_perencanaan_mari[2] + $nilai_perencanaan_mari[3] + $nilai_perencanaan_mari[4] + $nilai_perencanaan_mari[5] + $nilai_perencanaan_mari[6] + $nilai_perencanaan_mari[7]) / $nominal_master_mari * 100; //agustus
      } else {
        $nilai_perencanaan_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_perencanaan_mari[8] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_perencanaan_anggaran_persenan_mari[] = ($nilai_perencanaan_mari[0] + $nilai_perencanaan_mari[1] + $nilai_perencanaan_mari[2] + $nilai_perencanaan_mari[3] + $nilai_perencanaan_mari[4] + $nilai_perencanaan_mari[5] + $nilai_perencanaan_mari[6] + $nilai_perencanaan_mari[7] + $nilai_perencanaan_mari[8]) / $nominal_master_mari * 100; //september
      } else {
        $nilai_perencanaan_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_perencanaan_mari[9] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_perencanaan_anggaran_persenan_mari[] = ($nilai_perencanaan_mari[0] + $nilai_perencanaan_mari[1] + $nilai_perencanaan_mari[2] + $nilai_perencanaan_mari[3] + $nilai_perencanaan_mari[4] + $nilai_perencanaan_mari[5] + $nilai_perencanaan_mari[6] + $nilai_perencanaan_mari[7] + $nilai_perencanaan_mari[8] + $nilai_perencanaan_mari[9]) / $nominal_master_mari * 100; //oktober
      } else {
        $nilai_perencanaan_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_perencanaan_mari[10] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_perencanaan_anggaran_persenan_mari[] = ($nilai_perencanaan_mari[0] + $nilai_perencanaan_mari[1] + $nilai_perencanaan_mari[2] + $nilai_perencanaan_mari[3] + $nilai_perencanaan_mari[4] + $nilai_perencanaan_mari[5] + $nilai_perencanaan_mari[6] + $nilai_perencanaan_mari[7] + $nilai_perencanaan_mari[8] + $nilai_perencanaan_mari[9] + $nilai_perencanaan_mari[10]) / $nominal_master_mari * 100; //november
      } else {
        $nilai_perencanaan_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_perencanaan_mari[11] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_perencanaan_anggaran_persenan_mari[] = ($nilai_perencanaan_mari[0] + $nilai_perencanaan_mari[1] + $nilai_perencanaan_mari[2] + $nilai_perencanaan_mari[3] + $nilai_perencanaan_mari[4] + $nilai_perencanaan_mari[5] + $nilai_perencanaan_mari[6] + $nilai_perencanaan_mari[7] + $nilai_perencanaan_mari[8] + $nilai_perencanaan_mari[9] + $nilai_perencanaan_mari[10] + $nilai_perencanaan_mari[11]) / $nominal_master_mari * 100; //desember
      } else {
        $nilai_perencanaan_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_perencanaan_anggaran_persenan_mari[] = 0;
    }



    //grafik anggaran (realisasi anggaran)
    $tbl_bulan_realisasi_persenan_mari = DB::table('tb_realisasi_anggaran_mari')
      ->select(DB::raw('tb_realisasi_anggaran_mari.*,
             SUBSTRING(tb_realisasi_anggaran_mari.tanggal_realisasi_anggaran,6,2) as bulan_pecah'))
      ->whereYear('tanggal_realisasi_anggaran', '=', $filter_data_tahun_pimpinan_session)
      ->get();

    $myarray5 = [];

    foreach ($tbl_bulan_realisasi_persenan_mari as $data_mari) {
      $myarray5_mari[(int) $data_mari->bulan_pecah - 1] = (int) $data_mari->nilai_realisasi_anggaran;
    }

    for ($n = 0; $n < 12; $n++) {
      if (!isset($myarray5_mari[$n])) {
        $nilai_realisasi_mari[] = 0;
      } else {
        $nilai_realisasi_mari[] = $myarray5_mari[$n];
      }
    }


    if ($nilai_realisasi_mari[0] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_realisasi_anggaran_persenan_mari[] = $nilai_realisasi_mari[0] / $nominal_master_mari * 100; //januari
      } else {
        $nilai_realisasi_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_realisasi_mari[1] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_realisasi_anggaran_persenan_mari[] = ($nilai_realisasi_mari[0] + $nilai_realisasi_mari[1]) / $nominal_master_mari * 100; //februari
      } else {
        $nilai_realisasi_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_realisasi_mari[2] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_realisasi_anggaran_persenan_mari[] = ($nilai_realisasi_mari[0] + $nilai_realisasi_mari[1] + $nilai_realisasi_mari[2]) / $nominal_master_mari * 100; //maret
      } else {
        $nilai_realisasi_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_realisasi_mari[3] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_realisasi_anggaran_persenan_mari[] = ($nilai_realisasi_mari[0] + $nilai_realisasi_mari[1] + $nilai_realisasi_mari[2] + $nilai_realisasi_mari[3]) / $nominal_master_mari * 100; //april
      } else {
        $nilai_realisasi_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_realisasi_mari[4] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_realisasi_anggaran_persenan_mari[] = ($nilai_realisasi_mari[0] + $nilai_realisasi_mari[1] + $nilai_realisasi_mari[2] + $nilai_realisasi_mari[3] + $nilai_realisasi_mari[4]) / $nominal_master_mari * 100; //mei
      } else {
        $nilai_realisasi_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_realisasi_mari[5] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_realisasi_anggaran_persenan_mari[] = ($nilai_realisasi_mari[0] + $nilai_realisasi_mari[1] + $nilai_realisasi_mari[2] + $nilai_realisasi_mari[3] + $nilai_realisasi_mari[4] + $nilai_realisasi_mari[5]) / $nominal_master_mari * 100; //juni
      } else {
        $nilai_realisasi_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_realisasi_mari[6] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_realisasi_anggaran_persenan_mari[] = ($nilai_realisasi_mari[0] + $nilai_realisasi_mari[1] + $nilai_realisasi_mari[2] + $nilai_realisasi_mari[3] + $nilai_realisasi_mari[4] + $nilai_realisasi_mari[5] + $nilai_realisasi_mari[6]) / $nominal_master_mari * 100; //juli
      } else {
        $nilai_realisasi_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_realisasi_mari[7] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_realisasi_anggaran_persenan_mari[] = ($nilai_realisasi_mari[0] + $nilai_realisasi_mari[1] + $nilai_realisasi_mari[2] + $nilai_realisasi_mari[3] + $nilai_realisasi_mari[4] + $nilai_realisasi_mari[5] + $nilai_realisasi_mari[6] + $nilai_realisasi_mari[7]) / $nominal_master_mari * 100; //agustus
      } else {
        $nilai_realisasi_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_realisasi_mari[8] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_realisasi_anggaran_persenan_mari[] = ($nilai_realisasi_mari[0] + $nilai_realisasi_mari[1] + $nilai_realisasi_mari[2] + $nilai_realisasi_mari[3] + $nilai_realisasi_mari[4] + $nilai_realisasi_mari[5] + $nilai_realisasi_mari[6] + $nilai_realisasi_mari[7] + $nilai_realisasi_mari[8]) / $nominal_master_mari * 100; //september
      } else {
        $nilai_realisasi_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_realisasi_mari[9] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_realisasi_anggaran_persenan_mari[] = ($nilai_realisasi_mari[0] + $nilai_realisasi_mari[1] + $nilai_realisasi_mari[2] + $nilai_realisasi_mari[3] + $nilai_realisasi_mari[4] + $nilai_realisasi_mari[5] + $nilai_realisasi_mari[6] + $nilai_realisasi_mari[7] + $nilai_realisasi_mari[8] + $nilai_realisasi_mari[9]) / $nominal_master_mari * 100; //oktober
      } else {
        $nilai_realisasi_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_realisasi_mari[10] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_realisasi_anggaran_persenan_mari[] = ($nilai_realisasi_mari[0] + $nilai_realisasi_mari[1] + $nilai_realisasi_mari[2] + $nilai_realisasi_mari[3] + $nilai_realisasi_mari[4] + $nilai_realisasi_mari[5] + $nilai_realisasi_mari[6] + $nilai_realisasi_mari[7] + $nilai_realisasi_mari[8] + $nilai_realisasi_mari[9] + $nilai_realisasi_mari[10]) / $nominal_master_mari * 100; //november
      } else {
        $nilai_realisasi_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan_mari[] = 0;
    }

    if ($nilai_realisasi_mari[11] != 0) {
      if ($nominal_master_mari != 0) {
        $nilai_realisasi_anggaran_persenan_mari[] = ($nilai_realisasi_mari[0] + $nilai_realisasi_mari[1] + $nilai_realisasi_mari[2] + $nilai_realisasi_mari[3] + $nilai_realisasi_mari[4] + $nilai_realisasi_mari[5] + $nilai_realisasi_mari[6] + $nilai_realisasi_mari[7] + $nilai_realisasi_mari[8] + $nilai_realisasi_mari[9] + $nilai_realisasi_mari[10] + $nilai_realisasi_mari[11]) / $nominal_master_mari * 100; //desember
      } else {
        $nilai_realisasi_anggaran_persenan_mari[] = 0;
      }
    } else {
      $nilai_realisasi_anggaran_persenan_mari[] = 0;
    }

    // dd($nilai_perencanaan_anggaran_persenan_mari);
    return view('V_Backend.V_pimpinan.V_Dashboard', [
      'ambil_tb_laporan_detail_pp39_pdf' => $ambil_tb_laporan_detail_pp39_pdf,
      'ambil_tb_laporan_detail_perkara_pdf' => $ambil_tb_laporan_detail_perkara_pdf,
      'ambil_tb_laporan_detail_lpj01_pdf' => $ambil_tb_laporan_detail_lpj01_pdf,
      'ambil_tb_laporan_detail_lpj04_pdf' => $ambil_tb_laporan_detail_lpj04_pdf,
      'ambil_jumlah_laporan_per_bulan_untuk_grafik' => $ambil_jumlah_laporan_per_bulan_untuk_grafik,
      'nominal_master' => $nominal_master,
      'nilai_perencanaan_anggaran' => $nilai_perencanaan_anggaran,
      'nilai_realisasi_anggaran' => $nilai_realisasi_anggaran,
      'nilai_perencanaan_anggaran_persenan' => $nilai_perencanaan_anggaran_persenan,
      'nilai_realisasi_anggaran_persenan' => $nilai_realisasi_anggaran_persenan,
      'nominal_master_mari' => $nominal_master_mari,
      'nilai_perencanaan_anggaran_mari' => $nilai_perencanaan_anggaran_mari,
      'nilai_realisasi_anggaran_mari' => $nilai_realisasi_anggaran_mari,
      'nilai_perencanaan_anggaran_persenan_mari' => $nilai_perencanaan_anggaran_persenan_mari,
      'nilai_realisasi_anggaran_persenan_mari' => $nilai_realisasi_anggaran_persenan_mari
    ]);
  }

   public function cetak_pdf(Request $request)
    {
      $tanggal_mulai=$request->tanggal_mulai;
      $tanggal_akhir=$request->tanggal_akhir;

    // Fetch all customers from database
    // $data = Customer::get();

      $peserta = DB::table('users')
      ->where('tanggal_upload_detail_laporan','>',$tanggal_mulai)
      ->where('tanggal_upload_detail_laporan','<',$tanggal_akhir)
      ->get();

    	$pdf = PDF::loadview('V_Backend.V_pimpinan.V_cetakpdf',['peserta'=>$peserta]);
    	$pdf->save(storage_path().'_filename.pdf');
    	return $pdf->download('cetak_pimpinan_pdf');
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
      // dd(public_path(). "/File_Laporan/".$nama_file);
      // dd($nama_file);

      // $file= "file:///C:/xampp/htdocs/aplikasi_pengadilan_agama/public/File_Laporan/16063866265fbf83c2cf4491.pdf";
      //
      // $headers = array(
      //         'Content-Type: application/pdf',
      //       );
      //
      // return Response::download($file, 'filename.pdf', $headers);

    }
}
