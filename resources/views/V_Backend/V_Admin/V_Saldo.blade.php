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
          <h1>Saldo DIPA BADILAG</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/backend_admin_saldo_perencanaan') }}">Home</a></li>
            <li class="breadcrumb-item">Saldo</li>
            <li class="breadcrumb-item active">Saldo DIPA BADILAG</li>
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
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Table Saldo Perencanaan Tahun {{ Session::get('filter_data_tahun_admin')}}</h3>

              <div class="card-tools">
                <ul class="pagination pagination-sm float-right">
                  @if (count($saldo) === 1)
                      <li class="page-item"><button disabled type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modal-sm1">INPUT DATA</button></li>&nbsp;&nbsp;
                  @else
                      <li class="page-item"><button type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modal-sm1">INPUT DATA</button></li>&nbsp;&nbsp;
                  @endif

                </ul>
              </div>
              <!-- <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#modal-sm">Input Perencanaan Anggaran</button> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Nominal Saldo</th>
                    <th>Total Tergunakan</th>
                    <th>Sisa Nominal Saldo</th>
                    <th></th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($saldo as $data)

                  <tr>
                    <td><?php echo "Rp ".number_format($data->nominal,2,',','.');?> <span class="badge bg-success">(100%)</span></td>
                    <td><?php echo "Rp ".number_format($data->tergunakan,2,',','.');?> <span class="badge bg-success">(<?php $rumus1 = $data->tergunakan/$data->nominal*100; echo $rumus1;  ?>%)</span></td>
                    <td><?php echo "Rp ".number_format($data->sisa,2,',','.');?> <span class="badge bg-success">(<?php $rumus2 = $data->sisa/$data->nominal*100; echo $rumus2;  ?>%)</span></td>
                    <td align="center" style="width: 20%;">
                      <button class="btn btn-outline-info btn-flat open_modal"  data-target="#modal_laporan_edit" value="{{$data->id_saldo}}">Edit</button>
                      <a href="{{url('backend_admin_saldo_perencanaan_delete',$data->id_saldo)}}" class="btn btn-outline-danger btn-flat">Hapus</a>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->

          </div>
          <!-- /.card -->
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<!-- modal -->
<div class="modal fade" id="modal-sm1">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Input Saldo Tahun <?php echo date('Y'); ?></h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ url('/aksi_save_saldo/tambah_aksi') }}" enctype="multipart/form-data" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="modal-body">
          <div class="form-group">
            <label>Nominal Saldo</label>
            <input type="text" name="saldo" class="form-control" placeholder="Nominal Saldo">
          </div>
        </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- modal -->
<div id="modal_laporan_edit" class="modal fade">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">Edit Saldo Tahun {{ Session::get('filter_data_tahun_admin')}}</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ url('/aksi_update_saldo/update_aksi') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <input type="hidden" name="id_saldo" id="id_saldo" class="form-control">
        <div class="modal-body">
          <div class="form-group">
            <label>Nominal Saldo</label>
            <input type="text" name="nominal" id="nominal" class="form-control" placeholder="Nominal Saldo">
          </div>
        </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
@endsection

@section('script')
<script>

$(document).on('click','.open_modal',function(){
var url = "show_nominal";
var id_saldo= $(this).val();
$.get(url + '/' + id_saldo, function (data) {

  var data = JSON.parse(data);
  console.log(data);
  for(var i in data)
    {
    document.getElementById("id_saldo").value= data[i].id_saldo;
    document.getElementById("nominal").value= data[i].nominal;
    }
  $('#modal_laporan_edit').modal('show');
})
});

</script>
@endsection
