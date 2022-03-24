<?php

namespace App\Http\Controllers\C_Backend\C_Operator;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class C_Dashboard extends Controller
{

  public function index(Request $request)
  {

    $filter_data_tahun_operator_session = $request->session()->get('filter_data_tahun_operator');
    $tahun_ini = date('Y');
    //laporan pp39
    $tb_laporan_detail_pp39 = DB::select("SELECT `tb_laporan_detail`.file_laporan, SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 1,2) AS bulan_pecah
    FROM tb_laporan_detail
    JOIN tb_laporan ON `tb_laporan`.`id_laporan` = `tb_laporan_detail`.`id_laporan`
    WHERE SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 4,4) = '$filter_data_tahun_operator_session'
    AND tb_laporan_detail.`status_laporan_detail` = 'valid'
    AND `tb_laporan_detail`.`id_nama_laporan` = '1'");

    $myarray_pp39 = [];
    foreach ($tb_laporan_detail_pp39 as $data) {
     $myarray_pp39[(int)$data->bulan_pecah-1] = $data->file_laporan;
    }

    $ambil_tb_laporan_detail_pp39_pdf = [];
    for($i=0;$i<12; $i++){
     if(!isset($myarray_pp39[$i])){
       $ambil_tb_laporan_detail_pp39_pdf[] = "";
     }else{
       $ambil_tb_laporan_detail_pp39_pdf[] = $myarray_pp39[$i];
     }
    }


    //laporan perkara
    $tb_laporan_detail_perkara = DB::select("SELECT `tb_laporan_detail`.file_laporan, SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 1,2) AS bulan_pecah
    FROM tb_laporan_detail
    JOIN tb_laporan ON `tb_laporan`.`id_laporan` = `tb_laporan_detail`.`id_laporan`
    WHERE SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 4,4) = '$filter_data_tahun_operator_session'
    AND tb_laporan_detail.`status_laporan_detail` = 'valid'
    AND `tb_laporan_detail`.`id_nama_laporan` = '2'");

    $myarray_perkara = [];
    foreach ($tb_laporan_detail_perkara as $data) {
     $myarray_perkara[(int)$data->bulan_pecah-1] = $data->file_laporan;
    }

    $ambil_tb_laporan_detail_perkara_pdf = [];
    for($i=0;$i<12; $i++){
     if(!isset($myarray_perkara[$i])){
       $ambil_tb_laporan_detail_perkara_pdf[] = "";
     }else{
       $ambil_tb_laporan_detail_perkara_pdf[] = $myarray_perkara[$i];
     }
    }


    //laporan lpj01
    $tb_laporan_detail_lpj01 = DB::select("SELECT `tb_laporan_detail`.file_laporan, SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 1,2) AS bulan_pecah
    FROM tb_laporan_detail
    JOIN tb_laporan ON `tb_laporan`.`id_laporan` = `tb_laporan_detail`.`id_laporan`
    WHERE SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 4,4) = '$filter_data_tahun_operator_session'
    AND tb_laporan_detail.`status_laporan_detail` = 'valid'
    AND `tb_laporan_detail`.`id_nama_laporan` = '3'");

    $myarray_lpj01 = [];
    foreach ($tb_laporan_detail_lpj01 as $data) {
     $myarray_lpj01[(int)$data->bulan_pecah-1] = $data->file_laporan;
    }

    $ambil_tb_laporan_detail_lpj01_pdf = [];
    for($i=0;$i<12; $i++){
     if(!isset($myarray_lpj01[$i])){
       $ambil_tb_laporan_detail_lpj01_pdf[] = "";
     }else{
       $ambil_tb_laporan_detail_lpj01_pdf[] = $myarray_lpj01[$i];
     }
    }



    //laporan lpj04
    $tb_laporan_detail_lpj04 = DB::select("SELECT `tb_laporan_detail`.file_laporan, SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 1,2) AS bulan_pecah
    FROM tb_laporan_detail
    JOIN tb_laporan ON `tb_laporan`.`id_laporan` = `tb_laporan_detail`.`id_laporan`
    WHERE SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 4,4) = '$filter_data_tahun_operator_session'
    AND tb_laporan_detail.`status_laporan_detail` = 'valid'
    AND `tb_laporan_detail`.`id_nama_laporan` = '4'");

    $myarray_lpj04 = [];
    foreach ($tb_laporan_detail_lpj04 as $data) {
     $myarray_lpj04[(int)$data->bulan_pecah-1] = $data->file_laporan;
    }

    $ambil_tb_laporan_detail_lpj04_pdf = [];
    for($i=0;$i<12; $i++){
     if(!isset($myarray_lpj04[$i])){
       $ambil_tb_laporan_detail_lpj04_pdf[] = "";
     }else{
       $ambil_tb_laporan_detail_lpj04_pdf[] = $myarray_lpj04[$i];
     }
    }




    $tb_laporan_ambil_jumlah_laporan_per_bulan_untuk_grafik = DB::select("SELECT COUNT(`tb_laporan_detail`.file_laporan) as jumlah_laporan_per_bulan, SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 1,2) as bulan_pecah
    FROM tb_laporan_detail
    JOIN tb_laporan ON `tb_laporan`.`id_laporan` = `tb_laporan_detail`.`id_laporan`
    WHERE SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 4,4) = '$filter_data_tahun_operator_session'
    AND tb_laporan_detail.`status_laporan_detail` = 'valid'
    GROUP BY SUBSTRING(`tb_laporan`.`bulan_tahun_laporan`, 1,2)");

    $myarray_ambil_jumlah_laporan_per_bulan_untuk_grafik = [];
    foreach ($tb_laporan_ambil_jumlah_laporan_per_bulan_untuk_grafik as $data) {
     $myarray_ambil_jumlah_laporan_per_bulan_untuk_grafik[(int)$data->bulan_pecah-1] = $data->jumlah_laporan_per_bulan;
    }

    $ambil_jumlah_laporan_per_bulan_untuk_grafik = [];
    for($i=0;$i<12; $i++){
     if(!isset($myarray_ambil_jumlah_laporan_per_bulan_untuk_grafik[$i])){
       $ambil_jumlah_laporan_per_bulan_untuk_grafik[] = 0;
     }else{
       $ambil_jumlah_laporan_per_bulan_untuk_grafik[] = $myarray_ambil_jumlah_laporan_per_bulan_untuk_grafik[$i];
     }
    }

    // dd($ambil_jumlah_laporan_per_bulan_untuk_grafik);

    //anggaran dan realisasi
    $th_saatini = date('Y');

    $tbl_bulan_perencanaan = DB::table('tb_perencanaan_anggaran')
       ->select(DB::raw('tb_perencanaan_anggaran.*,
        SUBSTRING(tb_perencanaan_anggaran.tanggal_perencanaan_anggaran,6,2) as bulan_pecah'))
       ->whereYear('tanggal_perencanaan_anggaran', '=', $th_saatini )
       ->get();

       $myarray = [];

       foreach ($tbl_bulan_perencanaan as $data) {
        $myarray[(int)$data->bulan_pecah-1] = $data->nilai_perencanaan_anggaran;
       }



       $nilai_perencanaan_anggaran = [];
       for($i=0;$i<12; $i++){
        if(!isset($myarray[$i])){
          $nilai_perencanaan_anggaran[] = "0";
        }else{
          $nilai_perencanaan_anggaran[] = $myarray[$i];
        }
       }

      $tbl_bulan_realisasi = DB::table('tb_realisasi_anggaran')
        ->select(DB::raw('tb_realisasi_anggaran.*,
         SUBSTRING(tb_realisasi_anggaran.tanggal_realisasi_anggaran,6,2) as bulan_pecah'))
        ->whereYear('tb_realisasi_anggaran.tanggal_realisasi_anggaran', '=', $th_saatini )
        ->get();

        $myarray2 = [];

        foreach ($tbl_bulan_realisasi as $data) {
         $myarray2[(int)$data->bulan_pecah-1] = $data->nilai_realisasi_anggaran;
        }

        $nilai_realisasi_anggaran = [];
        for($i=0;$i<12; $i++){
         if(!isset($myarray2[$i])){
           $nilai_realisasi_anggaran[] = "0";
         }else{
           $nilai_realisasi_anggaran[] = $myarray2[$i];
         }
        }
    return view('V_Backend.V_Operator.V_Dashboard',[
      'ambil_tb_laporan_detail_pp39_pdf'=>$ambil_tb_laporan_detail_pp39_pdf,
      'ambil_tb_laporan_detail_perkara_pdf'=>$ambil_tb_laporan_detail_perkara_pdf,
      'ambil_tb_laporan_detail_lpj01_pdf'=>$ambil_tb_laporan_detail_lpj01_pdf,
      'ambil_tb_laporan_detail_lpj04_pdf'=>$ambil_tb_laporan_detail_lpj04_pdf,
      'ambil_jumlah_laporan_per_bulan_untuk_grafik'=>$ambil_jumlah_laporan_per_bulan_untuk_grafik,
      'nilai_perencanaan_anggaran'=>$nilai_perencanaan_anggaran,
      'nilai_realisasi_anggaran'=>$nilai_realisasi_anggaran
    ]);

  }
}
