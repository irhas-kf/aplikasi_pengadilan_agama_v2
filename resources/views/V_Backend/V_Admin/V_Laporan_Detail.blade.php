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
                      <th>nama laporan</th>
                      <th>file laporan</th>
                      <th>status detail laporan</th>
                      <th>action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $no = 1;
                    foreach ($tb_laporan_detail as $data) {
                    ?>
                      <tr>
                        <td><?php echo $no++ ?></td>
                        <td><?php echo $data->nama_laporan ?></td>
                        <td>
                          <?php echo $data->file_laporan ?>
                          <?php
                          if(substr($data->file_laporan,-3) == 'pdf'){
                          ?>
                          <a href="{{url('backend_admin_download_file',$data->file_laporan)}}" class="btn btn-outline-primary btn-flat"><i class="fas fa-file-pdf"></i>
                          </a>
                          <?php
                          }else if(substr($data->file_laporan,-4) == 'xlsx'){
                          ?>
                          <a href="{{url('backend_admin_download_file',$data->file_laporan)}}" class="btn btn-outline-primary btn-flat"><i class="fas fa-file-excel" style="color:green"></i>
                          </a>
                          <?php
                          }
                          ?>
                        </td>
                        <td><?php echo $data->status_laporan_detail ?></td>
                        <td>
                          <?php
                          if($data->status_laporan_detail == 'valid'){
                          ?>

                          <i class="fas fa-check"></i>
                          <!-- <button class="btn btn-outline-info btn-flat open_modal"  data-target="#revisi" value="{{$data->id_laporan_detail}}">revisi</button>
                          <a href="{{url('backend_admin_laporan_detail_update_valid',$data->id_laporan_detail)}}" class="btn btn-outline-primary btn-flat">valid</a> -->

                          <?php
                          }else if($data->status_laporan_detail == 'diajukan'){
                          ?>
                          <button class="btn btn-outline-info btn-flat open_modal"  data-target="#revisi" value="{{$data->id_laporan_detail}}">revisi</button>
                          <a href="{{url('backend_admin_laporan_detail_update_valid',$data->id_laporan_detail)}}" class="btn btn-outline-primary btn-flat">valid</a>
                          <!-- <a href="{{url('backend_admin_laporan_detail_update_valid',$data->id_laporan_detail)}}" class="btn btn-outline-primary btn-flat">valid</a> -->
                          <?php
                        }else if($data->status_laporan_detail == 'revisi'){
                          ?>
                          <!-- <button class="btn btn-outline-info btn-flat open_modal"  data-target="#revisi" value="{{$data->id_laporan_detail}}">revisi</button> -->
                          <!-- <a href="{{url('backend_admin_laporan_detail_update_valid',$data->id_laporan_detail)}}" class="btn btn-outline-primary btn-flat">valid</a> -->
                          <button class="btn btn-outline-info btn-flat open_modal"  data-target="#revisi" value="{{$data->id_laporan_detail}}">lihat revisi</button>
                          <?php
                          }
                          ?>

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



  <div class="modal fade" id="revisi">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Admin</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="{{url('backend_admin_laporan_detail_update_revisi')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!-- @csrf_field -->
            <input type="hidden" class="form-control" id="id_laporan" name="id_laporan" placeholder="Nama">
            <input type="hidden" class="form-control" id="id_laporan_detail" name="id_laporan_detail" placeholder="Nama">

            <div class="card-body" id="div_catatan_revisi_ada">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">catatan revisi terakhir</label>
                <div class="col-sm-10">
                  <div class="custom-file">
                    <textarea class="form-control" id="catatan_revisi_laporan_ada" name="catatan_revisi_laporan_ada" rows="3" placeholder="Enter ..." disabled></textarea>
                  </div>
                </div>
              </div>
            </div>

            <div class="card-body">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">nama laporan</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama_laporan" name="nama_laporan" placeholder="judul laporan" disabled>
                </div>
              </div>
            </div>
            <div class="card-body" id="catatan_revisi_input">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">catatan revisi</label>
                <div class="col-sm-10">
                  <div class="custom-file">
                    <textarea class="form-control" id="catatan_revisi" name="catatan_revisi" rows="3" placeholder="Enter ..." required></textarea>
                  </div>
                </div>
              </div>
            </div>



            <!-- /.card-footer -->
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
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

  <script>

$(document).on('click','.open_modal',function(){
  var url = "{{url('backend_admin_laporan_detail_tampil_form_revisi')}}";
  var id_laporan_detail= $(this).val();
  $.get(url + '/' + id_laporan_detail, function (data) {
    //success data
    // var obj = JSON.parse(json);
    // console.log(obj[0]["data.name"]);

    var data = JSON.parse(data);
    console.log(data);
    for(var i in data)
      {
      document.getElementById("id_laporan_detail").value= data[i].id_laporan_detail;
      document.getElementById("nama_laporan").value= data[i].nama_laporan;
      document.getElementById("id_laporan").value= data[i].id_laporan;

        if(data[i].status_laporan_detail == 'diajukan'){
          if(data[i].catatan_revisi == null){
            document.getElementById('div_catatan_revisi_ada').style.display = "none";
            document.getElementById('catatan_revisi_input').style.display = "block";
            document.getElementById("catatan_revisi_laporan_ada").value= data[i].catatan_revisi;
          }else{
            document.getElementById('div_catatan_revisi_ada').style.display = "block";
            document.getElementById('catatan_revisi_input').style.display = "block";
            document.getElementById("catatan_revisi_laporan_ada").value= data[i].catatan_revisi;
          }

        }else if(data[i].status_laporan_detail == 'revisi'){
          document.getElementById("catatan_revisi_laporan_ada").value= data[i].catatan_revisi;
          document.getElementById('div_catatan_revisi_ada').style.display = "block";
          document.getElementById('catatan_revisi_input').style.display = "none";
        }

      }


    // $('#nama_update').val(data.id);
    // $('#email_update').val(data.id);
    // $('#password_update').val(data.id);
    // $('#nohp_update').val(data.id);
    // $('#btn-save').val("update");
    $('#revisi').modal('show');


  })
});

</script>

<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

  @endsection
