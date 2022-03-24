<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// route login
// Route::post('/login', 'Auth\LoginController@login');


// route pimpinan

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/backend_profile', 'BackendProfileController@getDataAuth');
Route::post('/update_backend_profile', 'BackendProfileController@updateDataAuth')->name('update_backend_profile');

// route pimpinan
Route::group(['middleware'=> ['auth','ceklevel:pimpinan']], function(){
    //route menu dashboard
    Route::get('/backend_pimpinan_dashboard','C_Backend\C_Pimpinan\C_Dashboard@index')->name('pimpinan_dashboard');

    //route menu perencanaan anggaran DIPA MARI
    Route::get('/backend_pimpinan_perencanaan_anggaran_mari','C_Backend\C_Pimpinan\C_Perencanaan_anggaran_mari@index');
    Route::post('/pimpinan_aksi_save_perencanaan_anggaran_mari/tambah_aksi','C_Backend\C_Pimpinan\C_Perencanaan_anggaran_mari@aksi_save_perencanaan_anggaran');
    Route::get('/pimpinan_show_autocomplate_mari/{id}','C_Backend\C_Pimpinan\C_Perencanaan_anggaran_mari@show_autocomplate');
    Route::post('/pimpinan_aksi_update_saldo_mari/update_aksi','C_Backend\C_Pimpinan\C_Perencanaan_anggaran_mari@aksi_update_perencanaan_anggaran');

    //route menu perencanaan anggaran DIPA BADILAG
    Route::get('/backend_pimpinan_perencanaan_anggaran','C_Backend\C_Pimpinan\C_Perencanaan_anggaran@index')->name('pimpinan_perencanaan_anggaran');
    Route::post('/pimpinan_aksi_save_perencanaan_anggaran/tambah_aksi','C_Backend\C_Pimpinan\C_Perencanaan_anggaran@aksi_save_perencanaan_anggaran');
    Route::get('/pimpinan_show_autocomplate/{id}','C_Backend\C_Admin\C_Perencanaan_anggaran@show_autocomplate');
    Route::post('/pimpinan_aksi_update_saldo/update_aksi','C_Backend\C_Pimpinan\C_Perencanaan_anggaran@aksi_update_perencanaan_anggaran');

    //route menu realisasi anggran DIPA MARI
    Route::get('/backend_pimpinan_realisasi_anggaran_mari','C_Backend\C_Pimpinan\C_Realisasi_anggaran_mari@index');
    Route::post('/pimpinan_aksi_save_realisasi_anggaran_mari/tambah_aksi','C_Backend\C_Pimpinan\C_Realisasi_anggaran_mari@aksi_save_realisasi_anggaran');
    Route::post('/pimpinan_aksi_save_realisasi_anggaran_mari/update_aksi','C_Backend\C_Pimpinan\C_Realisasi_anggaran_mari@aksi_update_realisasi_anggaran');
    Route::get('/pimpinan_show_autocomplate_mari/realisasi/{id}','C_Backend\C_Pimpinan\C_Realisasi_anggaran_mari@show_autocomplate');
    Route::get('/pimpinan_show_autocomplate_edit_mari/realisasi/{id}','C_Backend\C_Pimpinan\C_Realisasi_anggaran_mari@show_autocomplate_edit');
    Route::get('/pimpinan_show_autocomplate_edit_mari/realisasi1/{id}','C_Backend\C_Pimpinan\C_Realisasi_anggaran_mari@show_autocomplate_edit1');

    //route menu realisasi anggran DIPA BADILAG
    Route::get('/backend_pimpinan_realisasi_anggaran','C_Backend\C_Pimpinan\C_Realisasi_anggaran@index')->name('pimpinan_realisasi_anggaran');
    Route::post('/pimpinan_aksi_save_realisasi_anggaran/tambah_aksi','C_Backend\C_Pimpinan\C_Realisasi_anggaran@aksi_save_realisasi_anggaran');
    Route::post('/pimpinan_aksi_save_realisasi_anggaran/update_aksi','C_Backend\C_Pimpinan\C_Realisasi_anggaran@aksi_update_realisasi_anggaran')->name('admin_update_realisasi');
    Route::get('/pimpinan_show_autocomplate/realisasi/{id}','C_Backend\C_Pimpinan\C_Realisasi_anggaran@show_autocomplate');
    Route::get('/pimpinan_show_autocomplate_edit/realisasi/{id}','C_Backend\C_Pimpinan\C_Realisasi_anggaran@show_autocomplate_edit');
    Route::get('/pimpinan_show_autocomplate_edit/realisasi1/{id}','C_Backend\C_Pimpinan\C_Realisasi_anggaran@show_autocomplate_edit1');

    //download file operator
    Route::get('backend_pimpinan_download_file/{nama_file}', 'C_Backend\C_Pimpinan\C_Dashboard@download_file_laporan_pdf');

    //menu filter data
    Route::get('/backend_pimpinan_filter_data', 'C_Backend\C_Pimpinan\C_Filter_Data@index');
    Route::get('/backend_pimpinan_filter_data_update_session_tahun/{tahun_session}', 'C_Backend\C_Pimpinan\C_Filter_Data@update_session_tahun');
});


// route admin
Route::group(['middleware'=> ['auth','ceklevel:admin']], function(){

    //route menu dashboard
    Route::get('/backend_admin_dashboard','C_Backend\C_Admin\C_Dashboard@index')->name('admin_dashboard');
    Route::get('/admin/pdf','C_Backend\C_Admin\C_Dashboard@export_pdf');

    //route menu saldo perencanaan DIPA MARI
    Route::get('/backend_admin_saldo_perencanaan_mari','C_Backend\C_Admin\C_Saldo_mari@index');
     Route::post('/aksi_save_saldo_mari/tambah_aksi','C_Backend\C_Admin\C_Saldo_mari@save_saldo');
     Route::get('/show_nominal_mari/{id}','C_Backend\C_Admin\C_Saldo_mari@show_saldo');
     Route::post('/aksi_update_saldo_mari/update_aksi','C_Backend\C_Admin\C_Saldo_mari@update_saldo');
     Route::get('backend_admin_saldo_perencanaan_delete_mari/{id}','C_Backend\C_Admin\C_Saldo_mari@destroy');

     //route menu saldo perencanaan DIPA BADILAG
     Route::get('/backend_admin_saldo_perencanaan','C_Backend\C_Admin\C_Saldo@index')->name('saldo_perencanaan');
      Route::post('/aksi_save_saldo/tambah_aksi','C_Backend\C_Admin\C_Saldo@save_saldo')->name('save_saldo');
      Route::get('/show_nominal/{id}','C_Backend\C_Admin\C_Saldo@show_saldo');
      Route::post('/aksi_update_saldo/update_aksi','C_Backend\C_Admin\C_Saldo@update_saldo')->name('update_saldo');
      Route::get('backend_admin_saldo_perencanaan_delete/{id}','C_Backend\C_Admin\C_Saldo@destroy');

    //route menu perencanaan anggaran DIPA MARI
    Route::get('/backend_admin_perencanaan_anggaran_mari','C_Backend\C_Admin\C_Perencanaan_anggaran_mari@index');
    Route::post('/aksi_save_perencanaan_anggaran_mari/tambah_aksi','C_Backend\C_Admin\C_Perencanaan_anggaran_mari@aksi_save_perencanaan_anggaran');
    Route::get('/show_autocomplate_mari/{id}','C_Backend\C_Admin\C_Perencanaan_anggaran_mari@show_autocomplate');
    Route::post('/aksi_update_perencanaan_anggaran_mari/update_aksi','C_Backend\C_Admin\C_Perencanaan_anggaran_mari@aksi_update_perencanaan_anggaran');

    //route menu perencanaan anggaran DIPA BADILAG
    Route::get('/backend_admin_perencanaan_anggaran','C_Backend\C_Admin\C_Perencanaan_anggaran@index')->name('admin_perencanaan_anggaran');
    Route::post('/aksi_save_perencanaan_anggaran/tambah_aksi','C_Backend\C_Admin\C_Perencanaan_anggaran@aksi_save_perencanaan_anggaran')->name('admin_save_perencanaan');
    Route::get('/show_autocomplate/{id}','C_Backend\C_Admin\C_Perencanaan_anggaran@show_autocomplate');
    Route::post('/aksi_update_perencanaan_anggaran/update_aksi','C_Backend\C_Admin\C_Perencanaan_anggaran@aksi_update_perencanaan_anggaran');

    //route menu realisasi anggaran DIPA MARI
    Route::get('/backend_admin_realisasi_anggaran_mari','C_Backend\C_Admin\C_realisasi_anggaran_mari@index');
    Route::post('/aksi_save_realisasi_anggaran_mari/tambah_aksi','C_Backend\C_Admin\C_realisasi_anggaran_mari@aksi_save_realisasi_anggaran');
    Route::post('/aksi_save_realisasi_anggaran_mari/update_aksi','C_Backend\C_Admin\C_realisasi_anggaran_mari@aksi_update_realisasi_anggaran');
    Route::get('/show_autocomplate_mari/realisasi/{id}','C_Backend\C_Admin\C_realisasi_anggaran_mari@show_autocomplate');
    Route::get('/show_autocomplate_edit_mari/realisasi/{id}','C_Backend\C_Admin\C_realisasi_anggaran_mari@show_autocomplate_edit');
    Route::get('/show_autocomplate_edit_mari/realisasi1/{id}','C_Backend\C_Admin\C_realisasi_anggaran_mari@show_autocomplate_edit1');

    //route menu realisasi anggaran DIPA BADILAG
    Route::get('/backend_admin_realisasi_anggaran','C_Backend\C_Admin\C_realisasi_anggaran@index')->name('admin_realisasi_anggaran');
    Route::post('/aksi_save_realisasi_anggaran/tambah_aksi','C_Backend\C_Admin\C_realisasi_anggaran@aksi_save_realisasi_anggaran')->name('admin_save_realisasi');
    Route::post('/aksi_save_realisasi_anggaran/update_aksi','C_Backend\C_Admin\C_realisasi_anggaran@aksi_update_realisasi_anggaran')->name('admin_update_realisasi');
    Route::get('/show_autocomplate/realisasi/{id}','C_Backend\C_Admin\C_realisasi_anggaran@show_autocomplate');
    Route::get('/show_autocomplate_edit/realisasi/{id}','C_Backend\C_Admin\C_realisasi_anggaran@show_autocomplate_edit');
    Route::get('/show_autocomplate_edit/realisasi1/{id}','C_Backend\C_Admin\C_realisasi_anggaran@show_autocomplate_edit1');

    //pdf eksport
    Route::get('/backend_admin_laporan','C_Backend\C_Admin\C_Laporan@index');

    //route menu laporam detail
    Route::get('/backend_admin_laporan_detail/{id}','C_Backend\C_Admin\C_Laporan_Detail@index');
    Route::get('/backend_admin_laporan_detail_tampil_form_revisi/{id}','C_Backend\C_Admin\C_Laporan_Detail@tampil_form_revisi');

    //download file operator
    Route::get('backend_admin_download_file/{nama_file}', 'C_Backend\C_Admin\C_Laporan_Detail@download_file_laporan_pdf');

    //status laporan detail update valid
    Route::get('/backend_admin_laporan_detail_update_valid/{id}','C_Backend\C_Admin\C_Laporan_Detail@laporan_detail_update_valid');

    //status laporan detail update revisi
    Route::post('/backend_admin_laporan_detail_update_revisi','C_Backend\C_Admin\C_Laporan_Detail@laporan_detail_update_revisi');

    //menu cetak laporan relaisasi dan Perencanaan DIPA MARI
    Route::get('/backend_admin_cetak_laporan_mari','C_Backend\C_Admin\C_Cetak_Laporan_mari@index');
    Route::get('/cetak_laporan_mari/tampil_aksi','C_Backend\C_Admin\C_Cetak_Laporan_mari@tampil_aksi');
    Route::get('/cetak_laporan_mari/export_pdf','C_Backend\C_Admin\C_Cetak_Laporan_mari@export_pdf');

    //menu cetak laporan relaisasi dan Perencanaan DIPA BADILAG
    Route::get('/backend_admin_cetak_laporan','C_Backend\C_Admin\C_Cetak_Laporan@index');
    Route::get('/cetak_laporan/tampil_aksi','C_Backend\C_Admin\C_Cetak_Laporan@tampil_aksi');
    Route::get('/cetak_laporan/export_pdf','C_Backend\C_Admin\C_Cetak_Laporan@export_pdf');

    //menu filter data
    Route::get('/backend_admin_filter_data', 'C_Backend\C_Admin\C_Filter_Data@index');
    Route::get('/backend_admin_filter_data_update_session_tahun/{tahun_session}', 'C_Backend\C_Admin\C_Filter_Data@update_session_tahun');

});


//route operator
Route::group(['middleware'=> ['auth','ceklevel:operator']], function(){
    //Dashboard
    Route::get('/backend_operator_dashboard','C_Backend\C_Operator\C_Dashboard@index')->name('operator_dashboard');

    //lapran
    Route::get('/backend_operator_laporan','C_Backend\C_Operator\C_Laporan@index')->name('operator_laporan');
    Route::post('backend_operator_laporan_tambah', 'C_Backend\C_Operator\C_Laporan@store');
    Route::get('backend_operator_laporan_delete/{id}','C_Backend\C_Operator\C_Laporan@destroy');
    Route::get('backend_operator_laporan_edit/{id}','C_Backend\C_Operator\C_Laporan@edit');
    Route::post('backend_operator_laporan_update','C_Backend\C_Operator\C_Laporan@update');
    //status laporan update diajukan
    Route::get('backend_operator_laporan_update_diajukan/{id}','C_Backend\C_Operator\C_Laporan@laporan_update_diajukan');

    //Laporan detail
    Route::get('/backend_operator_laporan_detail/{id}','C_Backend\C_Operator\C_Laporan_Detail@index');
    Route::post('/backend_operator_laporan_detail_tambah','C_Backend\C_Operator\C_Laporan_Detail@store');
    Route::get('backend_operator_laporan_detail_delete/{id}','C_Backend\C_Operator\C_Laporan_Detail@destroy');
    Route::get('backend_operator_laporan_detail_edit/{id}','C_Backend\C_Operator\C_Laporan_Detail@edit');
    Route::post('backend_operator_laporan_detail_update','C_Backend\C_Operator\C_Laporan_Detail@update');

    //download file operator
    Route::get('backend_operator_download_file/{nama_file}', 'C_Backend\C_Operator\C_Laporan_Detail@download_file_laporan_pdf');

    //menu filter data
    Route::get('/backend_operator_filter_data', 'C_Backend\C_Operator\C_Filter_Data@index');
    Route::get('/backend_operator_filter_data_update_session_tahun/{tahun_session}', 'C_Backend\C_Operator\C_Filter_Data@update_session_tahun');
});




Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();
