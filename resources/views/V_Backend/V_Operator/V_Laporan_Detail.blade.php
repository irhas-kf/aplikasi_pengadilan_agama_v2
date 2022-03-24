@extends('V_Backend.layout')

@section('konten')

@include('V_Backend.sidebar_operator')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Kepatuhan Laporan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item">Kepatuhan Laporan</li>
              <li class="breadcrumb-item active">Detail Kepatuhan Laporan</li>
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
                <h3 class="card-title">Data Kepatuhan Laporan</h3>
              </div>
              <!-- /.card-header -->
              <!-- <?php echo $laporan_yang_sudah_dimasukan_form->count(); ?> -->

              <div class="card-body">
              <?php
              if($ambil_status_laporan == 'diajukan'){
              ?>

              <?php
              }else if($ambil_status_laporan == 'revisi'){
              ?>
                <?php
                if($laporan_yang_sudah_dimasukan_form->count() == 0){
                ?>

                  <a href="{{url('backend_operator_laporan_update_diajukan',$id_laporan)}}" class="btn btn-primary float-right">
                      Ajukan
                  </a>

                <?php
                }else{
                ?>

                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_laporan_detail_tambah">
                    Tambah
                  </button>
                  <a href="{{url('backend_operator_laporan_update_diajukan',$id_laporan)}}" class="btn btn-primary float-right">
                    Ajukan
                  </a>

                <?php
                }
                ?>
                <?php
                }else if($ambil_status_laporan == 'valid'){
                ?>
                  <?php
                  if($ambil_laporan_detail_status_draft->count() > 0){
                    ?>
                    <a href="{{url('backend_operator_laporan_update_diajukan',$id_laporan)}}" class="btn btn-primary float-right">
                      Ajukan
                    </a>
                    <?php
                  }
                  ?>
                  <?php
                  if($laporan_yang_sudah_dimasukan_form->count() == 0){
                  ?>

                    <?php
                      if($ambil_laporan_detail_status_valid->count() == 4){

                      }else{
                    ?>

                    <?php
                      }
                    ?>


                  <?php
                  }else{
                  ?>

                    <?php
                      if($ambil_laporan_detail_status_valid->count() == 4){

                      }else if($ambil_laporan_detail_status_valid->count() <= 3){
                      ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_laporan_detail_tambah">
                          Tambah <?php echo $ambil_laporan_detail_status_draft->count(); ?>
                        </button>
                      <?php
                      }else{
                      ?>
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_laporan_detail_tambah">
                          Tambah
                        </button>
                        <a href="{{url('backend_operator_laporan_update_diajukan',$id_laporan)}}" class="btn btn-primary float-right">
                          Ajukan
                        </a>
                    <?php
                      }
                    ?>

                  <?php
                  }
                  ?>
                <?php
                }else if($ambil_status_laporan == 'draft'){
                ?>


                  <?php
                  if($laporan_yang_sudah_dimasukan_form->count() == 4){
                  ?>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_laporan_detail_tambah">
                    Tambah
                  </button>
                  <?php
                  }else{
                  ?>
                  <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_laporan_detail_tambah">
                    Tambah
                  </button>
                  <a href="{{url('backend_operator_laporan_update_diajukan',$id_laporan)}}" class="btn btn-primary float-right">
                    Ajukan
                  </a>
                  <?php
                  }
                  ?>


                <?php
                }
                ?>


                <br>
                <br>
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
                          <a href="{{url('backend_operator_download_file',$data->file_laporan)}}" class="btn btn-outline-primary btn-flat"><i class="fas fa-file-pdf"></i>
                          </a>
                          <?php
                          }else if(substr($data->file_laporan,-4) == 'xlsx'){
                          ?>
                          <a href="{{url('backend_operator_download_file',$data->file_laporan)}}" class="btn btn-outline-primary btn-flat"><i class="fas fa-file-excel" style="color:green"></i>
                          </a>
                          <?php
                          }
                          ?>
                        </td>
                        <td><?php echo $data->status_laporan_detail ?></td>
                        <td>
                        <?php
                          if($data->status_laporan_detail == 'diajukan'){
                        ?>
                          proses pengajuan ...
                        <?php
                        }else if($data->status_laporan_detail == 'valid'){
                        ?>

                          <i class="fas fa-check"></i>

                        <?php
                        }else if($data->status_laporan_detail == 'revisi'){
                        ?>

                        <button class="btn btn-outline-info btn-flat open_modal"  data-target="#modal_laporan_detail_edit" value="{{$data->id_laporan_detail}}">lihat revisi</button>
                        <!-- <a href="{{url('backend_operator_laporan_detail_delete',$data->id_laporan_detail)}}" class="btn btn-outline-danger btn-flat"><i class="fas fa-trash-alt"></i></a> -->

                        <?php
                        }else{
                        ?>

                        <button class="btn btn-outline-info btn-flat open_modal"  data-target="#modal_laporan_detail_edit" value="{{$data->id_laporan_detail}}">Edit</button>
                        <a href="{{url('backend_operator_laporan_detail_delete',$data->id_laporan_detail)}}" class="btn btn-outline-danger btn-flat"><i class="fas fa-trash-alt"></i></a>

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



  <div class="modal fade" id="modal_laporan_detail_tambah">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah operator</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="{{url('backend_operator_laporan_detail_tambah')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!-- @csrf_field -->
            <div class="card-body">
              <input type="hidden" class="form-control" id="id_laporan" name="id_laporan" value="<?php echo $id_laporan ?>" placeholder="Nama">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">nama laporan</label>
                <div class="col-sm-10">
                  <select class="form-control" id="id_nama_laporan" name="id_nama_laporan" style="width: 100%;" required>
                    <?php
                    foreach ($laporan_yang_sudah_dimasukan_form as $data)
                    {
                    ?>
                      <option value="<?php echo $data->id_nama_laporan ?>"> <?php echo $data->nama_laporan ?> </option>
                    <?php
                    }
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">file laporan</label>
                <div class="col-sm-10">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file_laporan" name="file_laporan" required>
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
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


  <div class="modal fade" id="modal_laporan_detail_edit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit operator</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="{{url('backend_operator_laporan_detail_update')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!-- @csrf_field -->
            <input type="hidden" class="form-control" id="id_laporan_detail_edit" name="id_laporan_detail_edit" placeholder="Nama">

            <div class="card-body" id="div_catatan_revisi">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">catatan revisi</label>
                <div class="col-sm-10">
                  <div class="custom-file">
                    <textarea class="form-control" id="catatan_revisi_laporan" name="catatan_revisi_laporan" rows="3" placeholder="Enter ..." disabled></textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">nama laporan</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="nama_laporan_detail_edit" name="nama_laporan_edit" placeholder="judul laporan" disabled>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">file laporan</label>
                <div class="col-sm-10">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="file_laporan_edit" name="file_laporan_edit" required>
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
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
  var url = "{{url('backend_operator_laporan_detail_edit')}}";
  var id_laporan_detail= $(this).val();
  $.get(url + '/' + id_laporan_detail, function (data) {
    //success data
    // var obj = JSON.parse(json);
    // console.log(obj[0]["data.name"]);



    var data = JSON.parse(data);
    console.log(data);
    for(var i in data)
      {
      document.getElementById("id_laporan_detail_edit").value= data[i].id_laporan_detail;
      document.getElementById("nama_laporan_detail_edit").value= data[i].nama_laporan;
      // document.getElementById("catatan_revisi_laporan").value= data[i].catatan_revisi;

        if(data[i].catatan_revisi == null){
          document.getElementById('div_catatan_revisi').style.display = "none";
        }else{
          document.getElementById("catatan_revisi_laporan").value= data[i].catatan_revisi;
          document.getElementById('div_catatan_revisi').style.display = "block";
        }

      }




    // $('#nama_update').val(data.id);
    // $('#email_update').val(data.id);
    // $('#password_update').val(data.id);
    // $('#nohp_update').val(data.id);
    // $('#btn-save').val("update");
    $('#modal_laporan_detail_edit').modal('show');


  })
});

</script>

<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

<script>
    var msg = '{{Session::get('alert')}}';
    var exist = '{{Session::has('alert')}}';
    if(exist){
      alert(msg);
    }
</script>

  @endsection
