<html>
<head>
  <title>Cetak PDF</title>
    <link rel="stylesheet" href="{{ asset('S_Backend/dist/css/adminlte.min.css') }}">
</head>
<body>
  <div class="row">
    <img align="center" width="10%" style="display: block; margin-left:0%;" src="{{ asset('S_Backend/dist/img/pa.png') }}">
    <img align="center" width="35%" height="35%" style="display: block; margin-left:22%; padding-top:5px;" src="{{ asset('S_Backend/dist/img/keker.png') }}">
  </div>
<p align="center">bulan <strong><?php echo $bulan_awal_pilih; ?></strong> sampai <strong><?php echo $bulan_akhir_pilih; ?></strong></p>
<!-- <img width="50%" style="display: block; margin-left:25%;" src="{{ asset('S_Backend/dist/img/garis.png') }}"> -->
<!-- /.card-header -->
<div class="card-body">
  <h4>Perencanaan Anggaran <?php echo $perencanaamari." Tahun ".$filter_data_tahun_admin_session;?></h4>
  <table class="table table-bordered">
    <thead>
      <tr align="center" style="background-color:purple; color:white;">
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
        @foreach($nilai_bulan2 as $data => $value)
        <td>
          <?php echo "Rp ".number_format((float)$value,2,',','.');?><hr>
          <p align="center"><span class="badge bg-success">(<?php $rumus2 = (int)$value/$nominal_master*100; echo round($rumus2,2);  ?>%)</span></p>
          <p align="center"><span class="badge bg-success">(<?php echo round($nilai_perencanaan_anggaran_persenan[$no++],2);  ?>%)</span></p>
        </td>
        @endforeach
      </tr>
    </tbody>
  </table>
</div>
<!-- /.card-body -->

<!-- /.card-header -->
<div class="card-body">
  <h4>Realisasi Anggaran <?php echo $realisasimari." Tahun ".$filter_data_tahun_admin_session;?></h4>
  <table class="table table-bordered">
    <thead>
      <tr align="center" style="background-color:purple; color:white;">
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
        @foreach($nilai_bulan3 as $data => $value2)
        <td>
          <?php echo "Rp ".number_format((float)$value2,2,',','.');?><hr>
          <p align="center"><span class="badge bg-success">(<?php $rumus2 = (int)$value2/$nominal_master*100; echo round($rumus2,2);  ?>%)</span></p>
          <p align="center"><span class="badge bg-success">(<?php echo round($nilai_realisasi_anggaran_persenan[$no++],2);  ?>%)</span></p>
        </td>
        @endforeach
      </tr>
    </tbody>
  </table>
</div>
<!-- /.card-body -->

<script src="{{ asset('S_Backend/dist/js/adminlte.js') }}"></script>
<script>

  window.print();

</script>
</body>
</html>
