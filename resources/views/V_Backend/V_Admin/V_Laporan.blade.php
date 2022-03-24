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
            <h1>DataTables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DataTable with default features</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>judul laporan</th>
                      <th>bulan laporan</th>
                      <th>tanggal pengajuan laporan</th>
                      <th>tanggal konfirmasi valid</th>
                      <th>status laporan</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($tb_laporan as $data) {
                    ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data->judul_laporan ?></td>
                        <td><?php echo $data->bulan_tahun_laporan ?></td>
                        <td><?php echo $data->tanggal_pengajuan_laporan ?></td>
                        <td><?php echo $data->tanggal_konfirmasi_valid_laporan ?></td>
                        <!-- <td><?php echo $data->status_laporan ?></td> -->
                        <td>
                          <?php
                          if($data->status_laporan == 'valid'){
                            $jumlah_laporan_detail_valid = '';
                            foreach ($tb_laporan_detail as $data2) {
                              if($data2->id_laporan == $data->id_laporan){
                                if($data2->status_laporan_detail == 'valid'){
                                  $jumlah_laporan_detail_valid++;
                                }
                              }
                            }
                            echo $jumlah_laporan_detail_valid.'/4 laporan '.$data->status_laporan;
                          }else{
                            echo $data->status_laporan;
                          }
                          ?>
                        </td>
                        <td>
                        <a href="{{url('backend_admin_laporan_detail',$data->id_laporan)}}" class="btn btn-outline-primary btn-flat">detail</a>
                        </td>
                      </tr>
                    <?php
                    }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  @endsection

  @section('script')

  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true,
        "autoWidth": true,
        "searching": true,
        "paging": true,
      });
    });
  </script>


  @endsection
