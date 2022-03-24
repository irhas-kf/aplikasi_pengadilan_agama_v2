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
          <h1>Cetak Laporan</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/backend_admin_cetak_laporan') }}">Home</a></li>
            <li class="breadcrumb-item active">Cetak Laporan</li>
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
              <h3 class="card-title">Pilih Tahun Filter Data (Sekarang anda memilih tahun <?php echo $filter_data_tahun_admin_session; ?> )</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">

                <?php
                for ($i = $tahun_sekarang; $i >= 2020; $i--) {
                ?>
                  <div class="btn-group mr-3 mb-3" role="group" aria-label="Third group">
                    <?php
                    if ($i == $filter_data_tahun_admin_session) {
                    ?>

                      <a href="" class="btn btn-success disabled" style="padding:20px;">
                        <i class="fa fa-calendar-alt fa-8x" aria-hidden="true"></i>
                        <br>
                        <span style="font-size:20px;"><?php echo $i; ?></span>
                      </a>

                    <?php
                    } else {
                    ?>

                      <a href='{{url("backend_admin_filter_data_update_session_tahun/$i")}}' class="btn btn-success" style="padding:20px;">
                        <i class="fa fa-calendar-alt fa-8x" aria-hidden="true"></i>
                        <br>
                        <span style="font-size:20px;"><?php echo $i; ?></span>
                      </a>

                    <?php
                    }
                    ?>
                  </div>
                <?php
                }
                ?>


              </div>
            </div>

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
