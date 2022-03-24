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
              <li class="breadcrumb-item active">Kepatuhan Laporan</li>
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
              <div class="card-body">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal_laporan_tambah">
                  Tambah
                </button>
                <br>
                <br>
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
                        <?php
                        if($data->status_laporan == 'diajukan'){
                          ?>
                          <a href="{{url('backend_operator_laporan_detail',$data->id_laporan)}}" class="btn btn-outline-primary btn-flat">detail</a>
                          <?php
                        }
                        else{
                          ?>
                          <button class="btn btn-outline-info btn-flat open_modal"  data-target="#modal_laporan_edit" value="{{$data->id_laporan}}">Edit</button>
                          <a href="{{url('backend_operator_laporan_delete',$data->id_laporan)}}" class="btn btn-outline-danger btn-flat"><i class="fas fa-trash-alt"></i></a>
                          <a href="{{url('backend_operator_laporan_detail',$data->id_laporan)}}" class="btn btn-outline-primary btn-flat">detail</a>
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



  <div class="modal fade" id="modal_laporan_tambah">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Admin</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="{{url('backend_operator_laporan_tambah')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!-- @csrf_field -->
            <div class="card-body">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="judul_laporan" name="judul_laporan" placeholder="judul laporan" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Bulan - Tahun</label>
                <div class="col-sm-5">
                  <select class="form-control" id="laporan_bulan" name="laporan_bulan" style="width: 100%;" required>
                    <option value=""> Bulan </option>
                    <option value="01"> Januari </option>
                    <option value="02"> Februari </option>
                    <option value="03"> Maret </option>
                    <option value="04"> April </option>
                    <option value="05"> Mei </option>
                    <option value="06"> Juni </option>
                    <option value="07"> Juli </option>
                    <option value="08"> Agustus </option>
                    <option value="09"> September </option>
                    <option value="10"> Oktober </option>
                    <option value="11"> November </option>
                    <option value="12"> Desember </option>
                  </select>
                </div>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="laporan_tahun" name="laporan_tahun" placeholder="Tahun" value="{{ Session::get('filter_data_tahun_operator')}}" readonly="readonly">
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


  <div class="modal fade" id="modal_laporan_edit">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Tambah Admin</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="{{url('backend_operator_laporan_update')}}" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
            <!-- @csrf_field -->
            <input type="hidden" class="form-control" id="id_laporan_edit" name="id_laporan_edit" placeholder="Nama">
            <div class="card-body">
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="judul_laporan_edit" name="judul_laporan_edit" placeholder="judul laporan" required>
                </div>
              </div>
              <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label">bulan</label>
                <div class="col-sm-5">
                  <select class="form-control" id="laporan_bulan_edit" name="laporan_bulan_edit" style="width: 100%;" required>
                    <option id="01" value="01"> Januari </option>
                    <option id="02" value="02"> Februari </option>
                    <option id="03" value="03"> Maret </option>
                    <option id="04" value="04"> April </option>
                    <option id="05" value="05"> Mei </option>
                    <option id="06" value="06"> Juni </option>
                    <option id="07" value="07"> Juli </option>
                    <option id="08" value="08"> Agustus </option>
                    <option id="09" value="09"> September </option>
                    <option id="10" value="10"> Oktober </option>
                    <option id="11" value="11"> November </option>
                    <option id="12" value="12"> Desember </option>
                  </select>
                </div>
                <div class="col-sm-5">
                  <input type="text" class="form-control" id="laporan_tahun_edit" name="laporan_tahun_edit" placeholder="judul laporan" required>
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
  var url = "backend_operator_laporan_edit";
  var id_laporan= $(this).val();
  $.get(url + '/' + id_laporan, function (data) {
    //success data
    // var obj = JSON.parse(json);
    // console.log(obj[0]["data.name"]);

    var data = JSON.parse(data);
    console.log(data);
    for(var i in data)
      {
      document.getElementById("id_laporan_edit").value= data[i].id_laporan;
      document.getElementById("judul_laporan_edit").value= data[i].judul_laporan;
      var str_bulan_tahun_laporan = data[i].bulan_tahun_laporan;
      // document.getElementById("laporan_tahun_edit").value= str_bulan_tahun_laporan.substring(0,2);
      document.getElementById(str_bulan_tahun_laporan.substring(0,2)).selected = "true";
      document.getElementById("laporan_tahun_edit").value= str_bulan_tahun_laporan.substring(3,7);
      }


    // $('#nama_update').val(data.id);
    // $('#email_update').val(data.id);
    // $('#password_update').val(data.id);
    // $('#nohp_update').val(data.id);
    // $('#btn-save').val("update");
    $('#modal_laporan_edit').modal('show');


  })
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
