@extends('V_Backend.layout')

@section('konten')

@include('V_Backend.sidebar_admin')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Cetak Laporan DIPA MARI</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/backend_admin_cetak_laporan_mari') }}">Home</a></li>
            <li class="breadcrumb-item active">Cetak Laporan DIPA MARI</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- /.col -->
        <div class="col-md-12">
          <div class="card card-secondary">
            <div class="card-header">
              <h3 class="card-title">Pilih Bulan Awal dan Bulan Akhir</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <form method="get" action="{{ url('/cetak_laporan_mari/tampil_aksi') }}">
                @csrf
                <div class="row">
                  <div class="col-sm-4">
                    <div class="form-group">
                      <select name="bulanawal" class="form-control" required="">
                        <option value="">--- Bulan Awal ---</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-1">
                    <h3 align="center">s/d</h3>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-group">
                      <select name="bulanakhir" class="form-control" required="">
                        <option value="">--- Bulan Akhir ---</option>
                        <option value="01">Januari</option>
                        <option value="02">Februari</option>
                        <option value="03">Maret</option>
                        <option value="04">April</option>
                        <option value="05">Mei</option>
                        <option value="06">Juni</option>
                        <option value="07">Juli</option>
                        <option value="08">Agustus</option>
                        <option value="09">September</option>
                        <option value="10">Oktober</option>
                        <option value="11">November</option>
                        <option value="12">Desember</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-2">
                    <button type="submit" name="action" value="tampilkan" class="btn btn-primary btn-sm btn-block">TAMPILKAN</button>
                  </div>
                  <div class="col-sm-1">
                    <button type="submit" name="action" value="cetak" class="btn btn-success btn-sm btn-block">CETAK</button>
                  </div>
                </div>
              </form>
            </div>
            <!-- <button onclick="window.print(<?php url('cetak_laporan/export_pdf'); ?>)" class="btn btn-success btn-sm btn-block">CETAK</button> -->
            <!-- <button >Click me</button> -->
            <!-- /.card-body -->

          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection


@section('script')

<!-- <script>
  window.print();
</script> -->

@endsection
