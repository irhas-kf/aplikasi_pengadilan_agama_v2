<?php

namespace App\Http\Controllers\C_Backend\C_Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PDF;

class C_Cetak_Laporan_mari extends Controller
{

  public function index()
  {
    return view('V_Backend.V_Admin.V_Cetak_Laporan_mari');
  }

  public function tampil_aksi(Request $request)
  {
    switch ($request->input('action')) {
        case 'tampilkan':

        $filter_data_tahun_admin_session = $request->session()->get('filter_data_tahun_admin');
        $th_saatini = date('Y');

           $tb_saldo_mari = DB::table('tb_saldo_mari')
           ->select(DB::raw('tb_saldo_mari.nominal'))
           ->whereYear('tanggal', '=', $filter_data_tahun_admin_session )
           ->get();

           foreach ($tb_saldo_mari as $tbsaldo) {
             $nominal_master = $tbsaldo->nominal;
           }

            //search perencanaan
            $bulanawal = $request->input('bulanawal');
            $bulanakhir = $request->input('bulanakhir');

            $tbl_bulan2 = DB::select(
              "SELECT SUBSTRING(tb_perencanaan_anggaran_mari.`tanggal_perencanaan_anggaran`, 6,2) AS bulan_pecah,
              tb_perencanaan_anggaran_mari.*
              FROM tb_perencanaan_anggaran_mari
              WHERE SUBSTRING(tb_perencanaan_anggaran_mari.tanggal_perencanaan_anggaran, 1,4) = $filter_data_tahun_admin_session
              AND SUBSTRING(tb_perencanaan_anggaran_mari.tanggal_perencanaan_anggaran, 6,2)
              BETWEEN $bulanawal AND $bulanakhir
            ");

               $myarray2 = [];

               foreach ($tbl_bulan2 as $data2) {
                $myarray2[(int)$data2->bulan_pecah-1] = $data2->nilai_perencanaan_anggaran;
               }

               $nilai_bulan2 = [];
               for($j=0;$j<12; $j++){
                if(!isset($myarray2[$j])){
                  $nilai_bulan2[] = "";
                }else{
                  $nilai_bulan2[] = $myarray2[$j];
                }
               }

               //search realisasi
               $bulanawal = $request->input('bulanawal');
               $bulanakhir = $request->input('bulanakhir');

               $tbl_bulan3 = DB::select(
                 "SELECT SUBSTRING(tb_realisasi_anggaran_mari.`tanggal_realisasi_anggaran`, 6,2) AS bulan_pecah1,
                 tb_realisasi_anggaran_mari.*
                 FROM tb_realisasi_anggaran_mari
                 WHERE SUBSTRING(tb_realisasi_anggaran_mari.tanggal_realisasi_anggaran, 1,4) = $filter_data_tahun_admin_session
                 AND SUBSTRING(tb_realisasi_anggaran_mari.tanggal_realisasi_anggaran, 6,2)
                 BETWEEN $bulanawal AND $bulanakhir
               ");

                  $myarray3 = [];

                  foreach ($tbl_bulan3 as $data3) {
                   $myarray3[(int)$data3->bulan_pecah1-1] = $data3->nilai_realisasi_anggaran;
                  }

                  $nilai_bulan3 = [];
                  for($j=0;$j<12; $j++){
                   if(!isset($myarray3[$j])){
                     $nilai_bulan3[] = "";
                   }else{
                     $nilai_bulan3[] = $myarray3[$j];
                   }
                  }

                  // grafik anggaran (perencanaan anggaran)
                  $tbl_bulan_perencanaan_persenan = DB::table('tb_perencanaan_anggaran_mari')
                     ->select(DB::raw('tb_perencanaan_anggaran_mari.*,
                      SUBSTRING(tb_perencanaan_anggaran_mari.tanggal_perencanaan_anggaran,6,2) as bulan_pecah'))
                     ->whereYear('tanggal_perencanaan_anggaran', '=', $filter_data_tahun_admin_session )
                     ->get();

                     $myarray3 = [];

                     foreach ($tbl_bulan_perencanaan_persenan as $data) {
                      $myarray3[(int)$data->bulan_pecah-1] = $data->nilai_perencanaan_anggaran;
                     }


                     $nilai_perencanaan = [];

                     for($l=0;$l<12; $l++){
                      if(!isset($myarray3[$l])){
                        $nilai_perencanaan[] = 0;
                      }else{
                        $nilai_perencanaan[] = $myarray3[$l];
                      }
                     }

                     $nilai_perencanaan_anggaran_persenan = [];

                     if($nilai_perencanaan[0] != 0){
                       $nilai_perencanaan_anggaran_persenan[] = $nilai_perencanaan[0]/$nominal_master*100; //januari
                     }else{
                       $nilai_perencanaan_anggaran_persenan[] = 0;
                     }

                     if($nilai_perencanaan[1] != 0){
                       $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1])/$nominal_master*100; //februari
                     }else{
                       $nilai_perencanaan_anggaran_persenan[] = 0;
                     }

                     if($nilai_perencanaan[2] != 0){
                       $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2])/$nominal_master*100; //maret
                     }else{
                       $nilai_perencanaan_anggaran_persenan[] = 0;
                     }

                     if($nilai_perencanaan[3] != 0){
                       $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3])/$nominal_master*100; //april
                     }else{
                       $nilai_perencanaan_anggaran_persenan[] = 0;
                     }

                     if($nilai_perencanaan[4] != 0){
                       $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4])/$nominal_master*100; //mei
                     }else{
                       $nilai_perencanaan_anggaran_persenan[] = 0;
                     }

                     if($nilai_perencanaan[5] != 0){
                       $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4]+$nilai_perencanaan[5])/$nominal_master*100; //juni

                     }else{
                       $nilai_perencanaan_anggaran_persenan[] = 0;
                     }

                     if($nilai_perencanaan[6] != 0){
                       $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4]+$nilai_perencanaan[5]+$nilai_perencanaan[6])/$nominal_master*100; //juli

                     }else{
                       $nilai_perencanaan_anggaran_persenan[] = 0;
                     }

                     if($nilai_perencanaan[7] != 0){
                       $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4]+$nilai_perencanaan[5]+$nilai_perencanaan[6]+$nilai_perencanaan[7])/$nominal_master*100; //agustus

                     }else{
                       $nilai_perencanaan_anggaran_persenan[] = 0;
                     }

                     if($nilai_perencanaan[8] != 0){
                       $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4]+$nilai_perencanaan[5]+$nilai_perencanaan[6]+$nilai_perencanaan[7]+$nilai_perencanaan[8])/$nominal_master*100; //september

                     }else{
                       $nilai_perencanaan_anggaran_persenan[] = 0;
                     }

                     if($nilai_perencanaan[9] != 0){
                       $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4]+$nilai_perencanaan[5]+$nilai_perencanaan[6]+$nilai_perencanaan[7]+$nilai_perencanaan[8]+$nilai_perencanaan[9])/$nominal_master*100; //oktober

                     }else{
                       $nilai_perencanaan_anggaran_persenan[] = 0;
                     }

                     if($nilai_perencanaan[10] != 0){
                       $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4]+$nilai_perencanaan[5]+$nilai_perencanaan[6]+$nilai_perencanaan[7]+$nilai_perencanaan[8]+$nilai_perencanaan[9]+$nilai_perencanaan[10])/$nominal_master*100; //november
                     }else{
                       $nilai_perencanaan_anggaran_persenan[] = 0;
                     }

                     if($nilai_perencanaan[11] != 0){

                       $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4]+$nilai_perencanaan[5]+$nilai_perencanaan[6]+$nilai_perencanaan[7]+$nilai_perencanaan[8]+$nilai_perencanaan[9]+$nilai_perencanaan[10]+$nilai_perencanaan[11])/$nominal_master*100; //desember
                     }else{
                       $nilai_perencanaan_anggaran_persenan[] = 0;
                     }

                     //grafik anggaran (realisasi anggaran)
                     $tbl_bulan_realisasi_persenan = DB::table('tb_realisasi_anggaran_mari')
                       ->select(DB::raw('tb_realisasi_anggaran_mari.*,
                        SUBSTRING(tb_realisasi_anggaran_mari.tanggal_realisasi_anggaran,6,2) as bulan_pecah'))
                       ->whereYear('tanggal_realisasi_anggaran', '=', $filter_data_tahun_admin_session )
                       ->get();

                       $myarray5 = [];

                       foreach ($tbl_bulan_realisasi_persenan as $data) {
                        $myarray5[(int)$data->bulan_pecah-1] = (int)$data->nilai_realisasi_anggaran;
                       }

                       for($l=0;$l<12; $l++){
                        if(!isset($myarray5[$l])){
                          $nilai_realisasi[] = 0;
                        }else{
                          $nilai_realisasi[] = $myarray5[$l];
                        }
                       }


                       if($nilai_realisasi[0] != 0){
                         $nilai_realisasi_anggaran_persenan[] = $nilai_realisasi[0]/$nominal_master*100; //januari
                       }else{
                         $nilai_realisasi_anggaran_persenan[] = 0;
                       }

                       if($nilai_realisasi[1] != 0){
                         $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1])/$nominal_master*100; //februari
                       }else{
                         $nilai_realisasi_anggaran_persenan[] = 0;
                       }

                       if($nilai_realisasi[2] != 0){
                         $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2])/$nominal_master*100; //maret
                       }else{
                         $nilai_realisasi_anggaran_persenan[] = 0;
                       }

                       if($nilai_realisasi[3] != 0){
                         $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3])/$nominal_master*100; //april
                       }else{
                         $nilai_realisasi_anggaran_persenan[] = 0;
                       }

                       if($nilai_realisasi[4] != 0){
                         $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4])/$nominal_master*100; //mei
                       }else{
                         $nilai_realisasi_anggaran_persenan[] = 0;
                       }

                       if($nilai_realisasi[5] != 0){
                         $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4]+$nilai_realisasi[5])/$nominal_master*100; //juni

                       }else{
                         $nilai_realisasi_anggaran_persenan[] = 0;
                       }

                       if($nilai_realisasi[6] != 0){
                         $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4]+$nilai_realisasi[5]+$nilai_realisasi[6])/$nominal_master*100; //juli

                       }else{
                         $nilai_realisasi_anggaran_persenan[] = 0;
                       }

                       if($nilai_realisasi[7] != 0){
                         $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4]+$nilai_realisasi[5]+$nilai_realisasi[6]+$nilai_realisasi[7])/$nominal_master*100; //agustus

                       }else{
                         $nilai_realisasi_anggaran_persenan[] = 0;
                       }

                       if($nilai_realisasi[8] != 0){
                         $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4]+$nilai_realisasi[5]+$nilai_realisasi[6]+$nilai_realisasi[7]+$nilai_realisasi[8])/$nominal_master*100; //september

                       }else{
                         $nilai_realisasi_anggaran_persenan[] = 0;
                       }

                       if($nilai_realisasi[9] != 0){
                         $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4]+$nilai_realisasi[5]+$nilai_realisasi[6]+$nilai_realisasi[7]+$nilai_realisasi[8]+$nilai_realisasi[9])/$nominal_master*100; //oktober

                       }else{
                         $nilai_realisasi_anggaran_persenan[] = 0;
                       }

                       if($nilai_realisasi[10] != 0){
                         $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4]+$nilai_realisasi[5]+$nilai_realisasi[6]+$nilai_realisasi[7]+$nilai_realisasi[8]+$nilai_realisasi[9]+$nilai_realisasi[10])/$nominal_master*100; //november
                       }else{
                         $nilai_realisasi_anggaran_persenan[] = 0;
                       }

                       if($nilai_realisasi[11] != 0){

                         $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4]+$nilai_realisasi[5]+$nilai_realisasi[6]+$nilai_realisasi[7]+$nilai_realisasi[8]+$nilai_realisasi[9]+$nilai_realisasi[10]+$nilai_realisasi[11])/$nominal_master*100; //desember
                       }else{
                         $nilai_realisasi_anggaran_persenan[] = 0;
                       }

        return view('V_Backend.V_Admin.V_Cetak_View_Laporan_mari',compact('nilai_bulan2','nominal_master','nilai_bulan3','nilai_realisasi_anggaran_persenan','nilai_perencanaan_anggaran_persenan','filter_data_tahun_admin_session'));

            break;

        case 'cetak':

        $th_saatini = date('Y');
        $filter_data_tahun_admin_session = $request->session()->get('filter_data_tahun_admin');
        $perencanaamari = "DIPA MARI";
        $realisasimari = "DIPA MARI";
        // Fetch all customers from database
        //search perencanaan
        // $bulanawal = "01";
        // $bulanakhir = "12";
        $bulanawal = $request->input('bulanawal');
        $bulanakhir = $request->input('bulanakhir');

        $bulan_awal_pilih = "";
        if ($bulanawal == "01") {
          $bulan_awal_pilih = "Januari";
        }elseif ($bulanawal == "02") {
          $bulan_awal_pilih = "Februari";
        }elseif ($bulanawal == "03") {
          $bulan_awal_pilih = "Maret";
        }elseif ($bulanawal == "04") {
          $bulan_awal_pilih = "April";
        }elseif ($bulanawal == "05") {
          $bulan_awal_pilih = "Mei";
        }elseif ($bulanawal == "06") {
          $bulan_awal_pilih = "Juni";
        }elseif ($bulanawal == "07") {
          $bulan_awal_pilih = "Juli";
        }elseif ($bulanawal == "08") {
          $bulan_awal_pilih = "Agustus";
        }elseif ($bulanawal == "09") {
          $bulan_awal_pilih = "September";
        }elseif ($bulanawal == "10") {
          $bulan_awal_pilih = "Oktober";
        }elseif ($bulanawal == "11") {
          $bulan_awal_pilih = "November";
        }elseif ($bulanawal == "12") {
          $bulan_awal_pilih = "Desember";
        }

        $bulan_akhir_pilih = "";
        if ($bulanakhir == "01") {
          $bulan_akhir_pilih = "Januari";
        }elseif ($bulanakhir == "02") {
          $bulan_akhir_pilih = "Februari";
        }elseif ($bulanakhir == "03") {
          $bulan_akhir_pilih = "Maret";
        }elseif ($bulanakhir == "04") {
          $bulan_akhir_pilih = "April";
        }elseif ($bulanakhir == "05") {
          $bulan_akhir_pilih = "Mei";
        }elseif ($bulanakhir == "06") {
          $bulan_akhir_pilih = "Juni";
        }elseif ($bulanakhir == "07") {
          $bulan_akhir_pilih = "Juli";
        }elseif ($bulanakhir == "08") {
          $bulan_akhir_pilih = "Agustus";
        }elseif ($bulanakhir == "09") {
          $bulan_akhir_pilih = "September";
        }elseif ($bulanakhir == "10") {
          $bulan_akhir_pilih = "Oktober";
        }elseif ($bulanakhir == "11") {
          $bulan_akhir_pilih = "November";
        }elseif ($bulanakhir == "12") {
          $bulan_akhir_pilih = "Desember";
        }


        $tbl_bulan2 = DB::select(
          "SELECT SUBSTRING(tb_perencanaan_anggaran_mari.`tanggal_perencanaan_anggaran`, 6,2) AS bulan_pecah,
          tb_perencanaan_anggaran_mari.*
          FROM tb_perencanaan_anggaran_mari
          WHERE SUBSTRING(tb_perencanaan_anggaran_mari.tanggal_perencanaan_anggaran, 1,4) = $filter_data_tahun_admin_session
          AND SUBSTRING(tb_perencanaan_anggaran_mari.tanggal_perencanaan_anggaran, 6,2)
          BETWEEN $bulanawal AND $bulanakhir
        ");

           $myarray2 = [];

           foreach ($tbl_bulan2 as $data2) {
            $myarray2[(int)$data2->bulan_pecah-1] = $data2->nilai_perencanaan_anggaran;
           }

           $nilai_bulan2 = [];
           for($j=0;$j<12; $j++){
            if(!isset($myarray2[$j])){
              $nilai_bulan2[] = "";
            }else{
              $nilai_bulan2[] = $myarray2[$j];
            }
           }

           //search realisasi
           // $bulanawal = $request->input('bulanawal');
           // $bulanakhir = $request->input('bulanakhir');

           $tbl_bulan3 = DB::select(
             "SELECT SUBSTRING(tb_realisasi_anggaran_mari.`tanggal_realisasi_anggaran`, 6,2) AS bulan_pecah1,
             tb_realisasi_anggaran_mari.*
             FROM tb_realisasi_anggaran_mari
             WHERE SUBSTRING(tb_realisasi_anggaran_mari.tanggal_realisasi_anggaran, 1,4) = $filter_data_tahun_admin_session
             AND SUBSTRING(tb_realisasi_anggaran_mari.tanggal_realisasi_anggaran, 6,2)
             BETWEEN $bulanawal AND $bulanakhir
           ");

              $myarray3 = [];

              foreach ($tbl_bulan3 as $data3) {
               $myarray3[(int)$data3->bulan_pecah1-1] = $data3->nilai_realisasi_anggaran;
              }

              $nilai_bulan3 = [];
              for($j=0;$j<12; $j++){
               if(!isset($myarray3[$j])){
                 $nilai_bulan3[] = "";
               }else{
                 $nilai_bulan3[] = $myarray3[$j];
               }
              }

              $tb_saldo_mari = DB::table('tb_saldo_mari')
              ->select(DB::raw('tb_saldo_mari.nominal'))
              ->whereYear('tanggal', '=', $filter_data_tahun_admin_session )
              ->get();

              foreach ($tb_saldo_mari as $tbsaldo) {
                $nominal_master = $tbsaldo->nominal;
              }

              // grafik anggaran (perencanaan anggaran)
              $tbl_bulan_perencanaan_persenan = DB::table('tb_perencanaan_anggaran_mari')
                 ->select(DB::raw('tb_perencanaan_anggaran_mari.*,
                  SUBSTRING(tb_perencanaan_anggaran_mari.tanggal_perencanaan_anggaran,6,2) as bulan_pecah'))
                 ->whereYear('tanggal_perencanaan_anggaran', '=', $filter_data_tahun_admin_session )
                 ->get();

                 $myarray3 = [];

                 foreach ($tbl_bulan_perencanaan_persenan as $data) {
                  $myarray3[(int)$data->bulan_pecah-1] = $data->nilai_perencanaan_anggaran;
                 }


                 $nilai_perencanaan = [];

                 for($l=0;$l<12; $l++){
                  if(!isset($myarray3[$l])){
                    $nilai_perencanaan[] = 0;
                  }else{
                    $nilai_perencanaan[] = $myarray3[$l];
                  }
                 }

                 $nilai_perencanaan_anggaran_persenan = [];

                 if($nilai_perencanaan[0] != 0){
                   $nilai_perencanaan_anggaran_persenan[] = $nilai_perencanaan[0]/$nominal_master*100; //januari
                 }else{
                   $nilai_perencanaan_anggaran_persenan[] = 0;
                 }

                 if($nilai_perencanaan[1] != 0){
                   $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1])/$nominal_master*100; //februari
                 }else{
                   $nilai_perencanaan_anggaran_persenan[] = 0;
                 }

                 if($nilai_perencanaan[2] != 0){
                   $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2])/$nominal_master*100; //maret
                 }else{
                   $nilai_perencanaan_anggaran_persenan[] = 0;
                 }

                 if($nilai_perencanaan[3] != 0){
                   $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3])/$nominal_master*100; //april
                 }else{
                   $nilai_perencanaan_anggaran_persenan[] = 0;
                 }

                 if($nilai_perencanaan[4] != 0){
                   $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4])/$nominal_master*100; //mei
                 }else{
                   $nilai_perencanaan_anggaran_persenan[] = 0;
                 }

                 if($nilai_perencanaan[5] != 0){
                   $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4]+$nilai_perencanaan[5])/$nominal_master*100; //juni

                 }else{
                   $nilai_perencanaan_anggaran_persenan[] = 0;
                 }

                 if($nilai_perencanaan[6] != 0){
                   $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4]+$nilai_perencanaan[5]+$nilai_perencanaan[6])/$nominal_master*100; //juli

                 }else{
                   $nilai_perencanaan_anggaran_persenan[] = 0;
                 }

                 if($nilai_perencanaan[7] != 0){
                   $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4]+$nilai_perencanaan[5]+$nilai_perencanaan[6]+$nilai_perencanaan[7])/$nominal_master*100; //agustus

                 }else{
                   $nilai_perencanaan_anggaran_persenan[] = 0;
                 }

                 if($nilai_perencanaan[8] != 0){
                   $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4]+$nilai_perencanaan[5]+$nilai_perencanaan[6]+$nilai_perencanaan[7]+$nilai_perencanaan[8])/$nominal_master*100; //september

                 }else{
                   $nilai_perencanaan_anggaran_persenan[] = 0;
                 }

                 if($nilai_perencanaan[9] != 0){
                   $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4]+$nilai_perencanaan[5]+$nilai_perencanaan[6]+$nilai_perencanaan[7]+$nilai_perencanaan[8]+$nilai_perencanaan[9])/$nominal_master*100; //oktober

                 }else{
                   $nilai_perencanaan_anggaran_persenan[] = 0;
                 }

                 if($nilai_perencanaan[10] != 0){
                   $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4]+$nilai_perencanaan[5]+$nilai_perencanaan[6]+$nilai_perencanaan[7]+$nilai_perencanaan[8]+$nilai_perencanaan[9]+$nilai_perencanaan[10])/$nominal_master*100; //november
                 }else{
                   $nilai_perencanaan_anggaran_persenan[] = 0;
                 }

                 if($nilai_perencanaan[11] != 0){

                   $nilai_perencanaan_anggaran_persenan[] = ($nilai_perencanaan[0]+$nilai_perencanaan[1]+$nilai_perencanaan[2]+$nilai_perencanaan[3]+$nilai_perencanaan[4]+$nilai_perencanaan[5]+$nilai_perencanaan[6]+$nilai_perencanaan[7]+$nilai_perencanaan[8]+$nilai_perencanaan[9]+$nilai_perencanaan[10]+$nilai_perencanaan[11])/$nominal_master*100; //desember
                 }else{
                   $nilai_perencanaan_anggaran_persenan[] = 0;
                 }

                 //grafik anggaran (realisasi anggaran)
                 $tbl_bulan_realisasi_persenan = DB::table('tb_realisasi_anggaran_mari')
                   ->select(DB::raw('tb_realisasi_anggaran_mari.*,
                    SUBSTRING(tb_realisasi_anggaran_mari.tanggal_realisasi_anggaran,6,2) as bulan_pecah'))
                   ->whereYear('tanggal_realisasi_anggaran', '=', $filter_data_tahun_admin_session )
                   ->get();

                   $myarray5 = [];

                   foreach ($tbl_bulan_realisasi_persenan as $data) {
                    $myarray5[(int)$data->bulan_pecah-1] = (int)$data->nilai_realisasi_anggaran;
                   }

                   for($l=0;$l<12; $l++){
                    if(!isset($myarray5[$l])){
                      $nilai_realisasi[] = 0;
                    }else{
                      $nilai_realisasi[] = $myarray5[$l];
                    }
                   }


                   if($nilai_realisasi[0] != 0){
                     $nilai_realisasi_anggaran_persenan[] = $nilai_realisasi[0]/$nominal_master*100; //januari
                   }else{
                     $nilai_realisasi_anggaran_persenan[] = 0;
                   }

                   if($nilai_realisasi[1] != 0){
                     $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1])/$nominal_master*100; //februari
                   }else{
                     $nilai_realisasi_anggaran_persenan[] = 0;
                   }

                   if($nilai_realisasi[2] != 0){
                     $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2])/$nominal_master*100; //maret
                   }else{
                     $nilai_realisasi_anggaran_persenan[] = 0;
                   }

                   if($nilai_realisasi[3] != 0){
                     $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3])/$nominal_master*100; //april
                   }else{
                     $nilai_realisasi_anggaran_persenan[] = 0;
                   }

                   if($nilai_realisasi[4] != 0){
                     $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4])/$nominal_master*100; //mei
                   }else{
                     $nilai_realisasi_anggaran_persenan[] = 0;
                   }

                   if($nilai_realisasi[5] != 0){
                     $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4]+$nilai_realisasi[5])/$nominal_master*100; //juni

                   }else{
                     $nilai_realisasi_anggaran_persenan[] = 0;
                   }

                   if($nilai_realisasi[6] != 0){
                     $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4]+$nilai_realisasi[5]+$nilai_realisasi[6])/$nominal_master*100; //juli

                   }else{
                     $nilai_realisasi_anggaran_persenan[] = 0;
                   }

                   if($nilai_realisasi[7] != 0){
                     $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4]+$nilai_realisasi[5]+$nilai_realisasi[6]+$nilai_realisasi[7])/$nominal_master*100; //agustus

                   }else{
                     $nilai_realisasi_anggaran_persenan[] = 0;
                   }

                   if($nilai_realisasi[8] != 0){
                     $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4]+$nilai_realisasi[5]+$nilai_realisasi[6]+$nilai_realisasi[7]+$nilai_realisasi[8])/$nominal_master*100; //september

                   }else{
                     $nilai_realisasi_anggaran_persenan[] = 0;
                   }

                   if($nilai_realisasi[9] != 0){
                     $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4]+$nilai_realisasi[5]+$nilai_realisasi[6]+$nilai_realisasi[7]+$nilai_realisasi[8]+$nilai_realisasi[9])/$nominal_master*100; //oktober

                   }else{
                     $nilai_realisasi_anggaran_persenan[] = 0;
                   }

                   if($nilai_realisasi[10] != 0){
                     $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4]+$nilai_realisasi[5]+$nilai_realisasi[6]+$nilai_realisasi[7]+$nilai_realisasi[8]+$nilai_realisasi[9]+$nilai_realisasi[10])/$nominal_master*100; //november
                   }else{
                     $nilai_realisasi_anggaran_persenan[] = 0;
                   }

                   if($nilai_realisasi[11] != 0){

                     $nilai_realisasi_anggaran_persenan[] = ($nilai_realisasi[0]+$nilai_realisasi[1]+$nilai_realisasi[2]+$nilai_realisasi[3]+$nilai_realisasi[4]+$nilai_realisasi[5]+$nilai_realisasi[6]+$nilai_realisasi[7]+$nilai_realisasi[8]+$nilai_realisasi[9]+$nilai_realisasi[10]+$nilai_realisasi[11])/$nominal_master*100; //desember
                   }else{
                     $nilai_realisasi_anggaran_persenan[] = 0;
                   }

        //Send data to the view using loadView function of PDF facade
        // $pdf = PDF::loadView('V_Backend.cetakpdf',compact('nilai_bulan2','nilai_bulan3','nominal_master','bulan_awal_pilih','bulan_akhir_pilih','nilai_realisasi_anggaran_persenan','nilai_perencanaan_anggaran_persenan'))->setPaper('letter', 'landscape');
        // If you want to store the generated pdf to the server then you can use the store function
        // $pdf->save(storage_path().'_filename.pdf');
        // $pdf->stream("filename.pdf", array("Attachment" => false));
        // Finally, you can download the file using download function
        $name_identitas = date('Y-m-d');
        // return $pdf->download('Export Keker '.$name_identitas.'.pdf');
        return view('V_Backend.cetakpdf',compact('nilai_bulan2','nilai_bulan3','nominal_master','bulan_awal_pilih','bulan_akhir_pilih','nilai_realisasi_anggaran_persenan','nilai_perencanaan_anggaran_persenan','perencanaamari','realisasimari','filter_data_tahun_admin_session'));

            break;

    }
  }
}
