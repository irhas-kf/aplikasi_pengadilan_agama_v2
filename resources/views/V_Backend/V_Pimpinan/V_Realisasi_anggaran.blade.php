@extends('V_Backend.layout')

@section('konten')

@include('V_Backend.sidebar_pimpinan')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Realisasi Anggaran DIPA BADILAG</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ url('/backend_pimpinan_realisasi_anggaran') }}">Home</a></li>
            <li class="breadcrumb-item active">Realisasi Anggaran</li>
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
              <h3 class="card-title">Table Realisasi Tahun {{ Session::get('filter_data_tahun_pimpinan')}}</h3>

              <div class="card-tools">
                <ul class="pagination pagination-sm float-right">
                  <li class="page-item"><button type="button" class="btn btn-info btn-sm btn-block" data-toggle="modal" data-target="#modal-sm1">INPUT DATA</button></li>&nbsp;&nbsp;
                  <li class="page-item"><button type="button" class="btn btn-warning btn-sm btn-block" data-toggle="modal" data-target="#modal-sm2">EDIT DATA</button></li>
                </ul>
              </div>
              <!-- <button type="button" class="btn btn-primary btn-sm btn-block" data-toggle="modal" data-target="#modal-sm">Input Perencanaan Anggaran</button> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="scroll">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apr</th>
                      <th>May</th>
                      <th>Jun</th>
                      <th>Jul</th>
                      <th>Aug</th>
                      <th>Sep</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <?php
                      $no = 0;
                      ?>
                      @foreach($nilai_bulan as $data => $value)
                      <td align="center">
                        <?php
                        if ($nominal_master == 0) {
                          echo 0;
                        } else {
                          echo "Rp " . number_format((float) $value, 2, ',', '.');
                        }
                        ?>
                        <hr>
                        <p align="center"><span class="badge bg-success">
                            (<?php
                              if ($nominal_master == 0) {
                                echo 0;
                              } else {
                                $rumus2_mari = (int) $value / $nominal_master * 100;
                                echo round($rumus2_mari, 2);
                              }
                              ?>%)</span></p>
                        <p align="center"><span class="badge bg-success">(<?php echo round($nilai_realisasi_anggaran_persenan[$no++], 2);  ?>%)</span></p>
                      </td>
                      @endforeach
                    </tr>
                  </tbody>
                </table>
              </div>
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
        <h6 class="modal-title">INPUT REALISASI ANGGARAN</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ url('/pimpinan_aksi_save_realisasi_anggaran/tambah_aksi') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Pilih Bulan</label>
            <!-- <select id="tanggal" name="tanggal" onchange="inputrealisai()" class="form-control">
              <option value="">--- Bulan ---</option>
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
            </select> -->
            <select id="tanggal" name="tanggal" class="form-control" onchange="inputrealisai()" required="">

              <option value="">--- Bulan Akhir ---</option>
              <?php
              for ($i = 0; $i < count($ambil_bulan_realisasi_anggaran_form_input); $i++) {
              ?>

                <!-- <option value=""><?php echo $ambil_bulan_realisasi_anggaran_form_input[$i]; ?></option> -->
                <?php
                if ($ambil_bulan_realisasi_anggaran_form_input[$i] == '0') {
                ?>
                  <option value="01">Januari</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_input[$i] == '1') {
                ?>
                  <option value="02">Februari</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_input[$i] == '2') {
                ?>
                  <option value="03">Maret</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_input[$i] == '3') {
                ?>
                  <option value="04">April</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_input[$i] == '4') {
                ?>
                  <option value="05">Mei</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_input[$i] == '5') {
                ?>
                  <option value="06">Juni</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_input[$i] == '6') {
                ?>
                  <option value="07">Juli</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_input[$i] == '7') {
                ?>
                  <option value="08">Agustus</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_input[$i] == '8') {
                ?>
                  <option value="09">September</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_input[$i] == '9') {
                ?>
                  <option value="10">Oktober</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_input[$i] == '10') {
                ?>
                  <option value="11">November</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_input[$i] == '11') {
                ?>
                  <option value="12">Desember</option>
                <?php
                }
                ?>
              <?php
              }
              ?>


              <!-- <option value="01">Januari</option> -->

            </select>
          </div>
          <div class="form-group">
            <label>Perencanaan</label>
            <input type="text" id="nilai_perencanaan_anggaran" name="nilai_perencanaan_anggaran" class="form-control" readonly="">
          </div>
          <div class="form-group">
            <label>Realisasi</label>
            <input type="text" name="realisasi" class="form-control" placeholder="realisasi anggaran">
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
<div class="modal fade" id="modal-sm2">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title">EDIT REALISASI ANGGARAN</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action="{{ url('/pimpinan_aksi_save_realisasi_anggaran/update_aksi') }}" enctype="multipart/form-data">
        @csrf
        <div class="modal-body">
          <div class="form-group">
            <label>Pilih Bulan</label>
            <!-- <select id="tanggal_edit" name="tanggal_edit" onchange="editrealisai(this.value)" class="form-control">
              <option value="">--- Bulan ---</option>
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
            </select> -->

            <select id="tanggal_edit" name="tanggal_edit" class="form-control" onchange="editrealisai(this.value)" class="form-control">

              <option value="">--- Bulan Akhir ---</option>
              <?php
              for ($i = 0; $i < count($ambil_bulan_realisasi_anggaran_form_edit); $i++) {
              ?>
                <?php
                if ($ambil_bulan_realisasi_anggaran_form_edit[$i] == '') {
                ?>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_edit[$i] == '01') {
                ?>
                  <option value="01">Januari</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_edit[$i] == '02') {
                ?>
                  <option value="02">Februari</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_edit[$i] == '03') {
                ?>
                  <option value="03">Maret</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_edit[$i] == '04') {
                ?>
                  <option value="04">April</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_edit[$i] == '05') {
                ?>
                  <option value="05">Mei</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_edit[$i] == '06') {
                ?>
                  <option value="06">Juni</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_edit[$i] == '07') {
                ?>
                  <option value="07">Juli</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_edit[$i] == '08') {
                ?>
                  <option value="08">Agustus</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_edit[$i] == '09') {
                ?>
                  <option value="09">September</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_edit[$i] == '10') {
                ?>
                  <option value="10">Oktober</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_edit[$i] == '11') {
                ?>
                  <option value="11">November</option>
                <?php
                } else if ($ambil_bulan_realisasi_anggaran_form_edit[$i] == '12') {
                ?>
                  <option value="12">Desember</option>
                <?php
                }
                ?>

              <?php
              }
              ?>
              <!-- <option value="01">Januari</option> -->

            </select>
          </div>
          <div class="form-group">
            <label>Perencanaan</label>
            <input type="text" id="nilai_perencanaan_anggaran_edit" name="nilai_perencanaan_anggaran_edit" class="form-control" readonly="">
          </div>
          <div class="form-group">
            <label>Realisasi</label>
            <input type="text" id="nilai_perencanaan_realisasi_edit" name="nilai_perencanaan_realisasi_edit" class="form-control" placeholder="realisasi anggaran">
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
  function inputrealisai() {
    var x = document.getElementById("tanggal").value;
    var url = "{{url('pimpinan_show_autocomplate/realisasi')}}";
    $.get(url + '/' + x, function(data) {

      var data = JSON.parse(data);
      // console.log(data);
      if (data.length == 0) {

        document.getElementById("nilai_perencanaan_anggaran").value = '';

        Swal.fire(
          'WARNING',
          'bulan yang anda pilih belum terisi nilai perencanaan',
          'warning'
        )
      } else {
        for (var i in data) {
          document.getElementById("nilai_perencanaan_anggaran").value = data[i].nilai_perencanaan_anggaran;
        }
      }
      // console.log(data.length);
      console.log(x);
    })
  }
</script>

<script>
  function editrealisai(val) {

    var url = "{{url('/pimpinan_show_autocomplate_edit/realisasi')}}";
    $.get(url + '/' + val, function(data) {

      var data = JSON.parse(data);
      // console.log(data);
      if (data.length == 0) {
        Swal.fire(
          'WARNING',
          'bulan yang anda pilih belum terisi nilai perencanaan',
          'warning'
        )
      } else {
        for (var i in data) {
          document.getElementById("nilai_perencanaan_anggaran_edit").value = data[i].nilai_perencanaan_anggaran;
        }
      }
      console.log(data.length);
    })

    var url = "{{url('/pimpinan_show_autocomplate_edit/realisasi1')}}";
    $.get(url + '/' + val, function(data) {

      var data = JSON.parse(data);
      // console.log(data);
      if (data.length == 0) {


        Swal.fire(
          'WARNING',
          'bulan yang anda pilih belum terisi nilai perencanaan',
          'warning'
        )

      } else {
        for (var i in data) {
          document.getElementById("nilai_perencanaan_realisasi_edit").value = data[i].nilai_realisasi_anggaran;
        }
      }
      console.log(data.length);
    })
    // alert("The input value has changed. The new value is: "+ val);
  }
</script>

<script>
  function myFunction(val) {
    alert("The input value has changed. The new value is: " + val);
  }
</script>

<script>
  var msg = '{{Session::get('
  alert ')}}';
  var exist = '{{Session::has('
  alert ')}}';
  if (exist) {
    alert(msg);
  }
</script>
@endsection
@section('stylecss')
<style>
  .scroll {
    display: block;
    width: 100%;
    height: 100%;
    overflow: scroll;
  }

  .auto {
    display: block;
    width: 100%;
    height: 100%;
    overflow: auto;
  }
</style>
@endsection