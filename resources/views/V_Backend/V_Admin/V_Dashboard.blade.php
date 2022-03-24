@extends('V_Backend.layout')

@section('konten')

@include('V_Backend.sidebar_admin')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Dashboard</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
          </ol>
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">

        <div class="col-lg-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <span class="text-bold text-lg">Anggaran</span>
                <!-- <a href="javascript:void(0);">View Report</a> -->
              </div>
            </div>
            <div class="card-body">
              <ul class="nav nav-tabs" id="custom-content-below-tab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="custom-content-below-home-tab" data-toggle="pill" href="#custom-content-below-home" role="tab" aria-controls="custom-content-below-home" aria-selected="true">DIPA BADILAG</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="custom-content-below-profile-tab" data-toggle="pill" href="#custom-content-below-profile" role="tab" aria-controls="custom-content-below-profile" aria-selected="false">DIPA MARI</a>
                </li>
              </ul>
              <div class="tab-content" id="custom-content-below-tabContent">
                <div class="tab-pane fade show active" id="custom-content-below-home" role="tabpanel" aria-labelledby="custom-content-below-home-tab">
                  <div class="d-flex">
                    <p class="d-flex flex-column">
                      <!-- <span class="text-bold text-lg">Perencanaan Anggaran</span>
                    <span>Visitors Over Time</span> -->
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                      <span class="text-success">
                        <!-- <i class="fas fa-arrow-up"></i> 12.5% -->
                      </span>
                      <span class="text-muted">tahun {{ Session::get('filter_data_tahun_admin')}}</span>
                    </p>
                  </div>
                  <!-- /.d-flex -->

                  <p><strong>Grafik Anggaran DIPA BADILAG</strong></p>

                  <div class="position-relative mb-4">
                    <canvas id="grafik_anggran" height="200"></canvas>
                  </div>

                  <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                      <i class="fas fa-square text-primary"></i> rencana anggaran
                    </span>

                    <span>
                      <i class="fas fa-square text-gray"></i>realisasi anggaran
                    </span>
                  </div>
                  <p><strong>Perencanaan Anggaran DIPA BADILAG</strong></p>
                  <div class="scroll">
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="text-align:center">Januari</th>
                          <th style="text-align:center">Februari</th>
                          <th style="text-align:center">Maret</th>
                          <th style="text-align:center">April</th>
                          <th style="text-align:center">Mei</th>
                          <th style="text-align:center">Juni</th>
                          <th style="text-align:center">Juli</th>
                          <th style="text-align:center">Agustus</th>
                          <th style="text-align:center">September</th>
                          <th style="text-align:center">Oktober</th>
                          <th style="text-align:center">November</th>
                          <th style="text-align:center">Desember</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                          $no = 0;
                          ?>
                          @foreach($nilai_perencanaan_anggaran as $data => $value)
                          <td align="center">
                            <?php 
                            if ($nominal_master == 0) {
                              echo 0;
                            } else {
                              echo "Rp " . number_format((float) $value, 2, ',', '.'); 
                            }
                            ?>
                            <hr>
                            <p align="center"><span class="badge bg-success">(
                                <?php
                                if ($nominal_master == 0) {
                                  echo 0;
                                } else {
                                  $rumus2 = (int) $value / $nominal_master * 100;
                                  echo round($rumus2, 2);
                                }
                                ?>%)</span></p>
                            <p align="center"><span class="badge bg-success">(
                                <?php echo round($nilai_perencanaan_anggaran_persenan[$no++], 2);  ?>%)</span></p>
                          </td>
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                  </div>

                  <p><strong>Realisasi Anggaran DIPA BADILAG</strong></p>
                  <div class="scroll">
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="text-align:center">Januari</th>
                          <th style="text-align:center">Februari</th>
                          <th style="text-align:center">Maret</th>
                          <th style="text-align:center">April</th>
                          <th style="text-align:center">Mei</th>
                          <th style="text-align:center">Juni</th>
                          <th style="text-align:center">Juli</th>
                          <th style="text-align:center">Agustus</th>
                          <th style="text-align:center">September</th>
                          <th style="text-align:center">Oktober</th>
                          <th style="text-align:center">November</th>
                          <th style="text-align:center">Desember</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                          $no = 0;
                          ?>
                          @foreach($nilai_realisasi_anggaran as $data => $value2)
                          <td align="center">
                            <?php
                            if ($nominal_master == 0) {
                              echo 0;
                            } else {
                              echo "Rp " . number_format((float) $value2, 2, ',', '.');
                            }

                            ?>
                            <hr>
                            <p align="center"><span class="badge bg-success">(
                                <?php
                                if ($nominal_master == 0) {
                                  echo 0;
                                } else {
                                  $rumus2 = (int) $value2 / $nominal_master * 100;
                                  echo round($rumus2, 2);
                                }
                                ?>%)</span></p>
                            <p align="center"><span class="badge bg-success">
                                (<?php echo round($nilai_realisasi_anggaran_persenan[$no++], 2);  ?>%)</span></p>
                          </td>
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
                <div class="tab-pane fade" id="custom-content-below-profile" role="tabpanel" aria-labelledby="custom-content-below-profile-tab">
                  <div class="d-flex">
                    <p class="d-flex flex-column">
                      <!-- <span class="text-bold text-lg">Perencanaan Anggaran</span>
                    <span>Visitors Over Time</span> -->
                    </p>
                    <p class="ml-auto d-flex flex-column text-right">
                      <span class="text-success">
                        <!-- <i class="fas fa-arrow-up"></i> 12.5% -->
                      </span>
                      <span class="text-muted">tahun {{ Session::get('filter_data_tahun_admin')}}</span>
                    </p>
                  </div>
                  <!-- /.d-flex -->

                  <p><strong>Grafik Anggaran DIPA MARI</strong></p>
                  <!-- <canvas id="grafik_anggran_mari"></canvas> -->
                  <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 200px;">
                    <canvas id="grafik_anggran_mari" height="200" style="height: 200px;"></canvas>
                  </div>


                  <div class="d-flex flex-row justify-content-end">
                    <span class="mr-2">
                      <i class="fas fa-square text-primary"></i> rencana anggaran
                    </span>

                    <span>
                      <i class="fas fa-square text-gray"></i>realisasi anggaran
                    </span>
                  </div>

                  <p><strong>Perencanaan Anggaran DIPA MARI</strong></p>
                  <div class="scroll">
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="text-align:center">Januari</th>
                          <th style="text-align:center">Februari</th>
                          <th style="text-align:center">Maret</th>
                          <th style="text-align:center">April</th>
                          <th style="text-align:center">Mei</th>
                          <th style="text-align:center">Juni</th>
                          <th style="text-align:center">Juli</th>
                          <th style="text-align:center">Agustus</th>
                          <th style="text-align:center">September</th>
                          <th style="text-align:center">Oktober</th>
                          <th style="text-align:center">November</th>
                          <th style="text-align:center">Desember</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                          $no = 0;
                          ?>
                          @foreach($nilai_perencanaan_anggaran_mari as $data => $value)
                          <td align="center">
                            <?php
                            if ($nominal_master_mari == 0) {
                              echo 0;
                            } else {
                              echo "Rp " . number_format((float) $value, 2, ',', '.');
                            }
                            ?>
                            <hr>
                            <p align="center"><span class="badge bg-success">
                                (<?php
                                  if ($nominal_master_mari == 0) {
                                    echo 0;
                                  } else {
                                    $rumus2_mari = (int) $value / $nominal_master_mari * 100;
                                    echo round($rumus2_mari, 2);
                                  }
                                  ?>%)</span></p>
                            <p align="center"><span class="badge bg-success">(<?php echo round($nilai_perencanaan_anggaran_persenan_mari[$no++], 2);  ?>%)</span></p>
                          </td>
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                  </div>


                  <p><strong>Realisasi Anggaran DIPA MARI</strong></p>
                  <div class="scroll">
                    <table class="table">
                      <thead>
                        <tr>
                          <th style="text-align:center">Januari</th>
                          <th style="text-align:center">Februari</th>
                          <th style="text-align:center">Maret</th>
                          <th style="text-align:center">April</th>
                          <th style="text-align:center">Mei</th>
                          <th style="text-align:center">Juni</th>
                          <th style="text-align:center">Juli</th>
                          <th style="text-align:center">Agustus</th>
                          <th style="text-align:center">September</th>
                          <th style="text-align:center">Oktober</th>
                          <th style="text-align:center">November</th>
                          <th style="text-align:center">Desember</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <?php
                          $no = 0;
                          ?>
                          @foreach($nilai_realisasi_anggaran_mari as $data => $value2)
                          <td align="center">
                            <?php
                            if ($nominal_master_mari == 0) {
                              echo 0;
                            } else {
                              echo "Rp " . number_format((float) $value2, 2, ',', '.');
                            }
                            ?>
                            <hr>
                            <p align="center"><span class="badge bg-success">
                                (<?php
                                  if ($nominal_master_mari == 0) {
                                    echo 0;
                                  } else {
                                    $rumus2_mari = (int) $value2 / $nominal_master_mari * 100;
                                    echo round($rumus2_mari, 2);
                                  }

                                  ?>%)</span></p>
                            <p align="center"><span class="badge bg-success">(<?php echo round($nilai_realisasi_anggaran_persenan_mari[$no++], 2);  ?>%)</span></p>
                          </td>
                          @endforeach
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>

            </div>
          </div>
          <!-- /.card -->
        </div>



        <div class="col-lg-12">
          <div class="card">
            <div class="card-header border-0">
              <div class="d-flex justify-content-between">
                <span class="text-bold text-lg">Kepatuhan Laporan</span>
                <!-- <a href="javascript:void(0);">View Report</a> -->
              </div>
            </div>
            <div class="card-body">
              <div class="d-flex">
                <p class="d-flex flex-column">
                  <!-- <span class="text-bold text-lg">820</span>
                    <span>Visitors Over Time</span> -->
                </p>
                <p class="ml-auto d-flex flex-column text-right">
                  <span class="text-success">
                    <!-- <i class="fas fa-arrow-up"></i> 12.5% -->
                  </span>
                  <span class="text-muted">tahun {{ Session::get('filter_data_tahun_admin')}}</span>
                </p>
              </div>

              <div class="position-relative mb-4">
                <canvas id="grafik_kepatuhan_laporan" height="200"></canvas>
              </div>

              <div class="d-flex flex-row justify-content-end">
                <span class="mr-2">
                  <i class="fas fa-square text-primary"></i> Kepatuhan Laporan
                </span>
              </div>

              <p><strong>Tabel Kepatuhan Laporan tahun {{ Session::get('filter_data_tahun_admin')}}</strong></p>

              <div class="scroll">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th></th>
                      <th style="text-align:center">Januari</th>
                      <th style="text-align:center">Februari</th>
                      <th style="text-align:center">Maret</th>
                      <th style="text-align:center">April</th>
                      <th style="text-align:center">Mei</th>
                      <th style="text-align:center">Juni</th>
                      <th style="text-align:center">Juli</th>
                      <th style="text-align:center">Agustus</th>
                      <th style="text-align:center">September</th>
                      <th style="text-align:center">Oktober</th>
                      <th style="text-align:center">November</th>
                      <th style="text-align:center">Desember</th>
                    </tr>
                  </thead>
                  <tbody>


                    <tr>
                      <td>perkara</td>
                      <?php foreach ($ambil_tb_laporan_detail_perkara_pdf as $data => $value_perkara_pdf) {
                      ?>
                        <?php
                        if ($value_perkara_pdf == '') {
                        ?>
                          <td style="text-align:center">tidak ada</td>
                        <?php
                        } else if (substr($value_perkara_pdf, -3) == 'pdf') {
                        ?>
                          <td style="text-align:center"><a href="{{url('backend_admin_download_file',$value_perkara_pdf)}}" class="btn btn-outline-primary btn-flat"><i class="fas fa-file-pdf"></i></a></td>
                        <?php
                        } else if (substr($value_perkara_pdf, -4) == 'xlsx') {
                        ?>
                          <td style="text-align:center"><a href="{{url('backend_admin_download_file',$value_perkara_pdf)}}" class="btn btn-outline-primary btn-flat"><i class="fas fa-file-excel" style="color:green"></i></a></td>
                        <?php
                        }
                        ?>

                      <?php
                      }
                      ?>

                    </tr>

                    <tr>
                      <td>pp39</td>
                      <?php foreach ($ambil_tb_laporan_detail_pp39_pdf as $data => $value_pp39_pdf) {
                      ?>
                        <?php
                        if ($value_pp39_pdf == '') {
                        ?>
                          <td style="text-align:center">tidak ada</td>
                        <?php
                        } else if (substr($value_pp39_pdf, -3) == 'pdf') {
                        ?>
                          <td style="text-align:center"><a href="{{url('backend_admin_download_file',$value_pp39_pdf)}}" class="btn btn-outline-primary btn-flat"><i class="fas fa-file-pdf"></i></a></td>
                        <?php
                        } else if (substr($value_pp39_pdf, -4) == 'xlsx') {
                        ?>
                          <td style="text-align:center"><a href="{{url('backend_admin_download_file',$value_pp39_pdf)}}" class="btn btn-outline-primary btn-flat"><i class="fas fa-file-excel" style="color:green"></i></a></td>
                        <?php
                        }
                        ?>
                      <?php
                      }
                      ?>

                    </tr>

                    <tr>
                      <td>lpj01</td>
                      <?php foreach ($ambil_tb_laporan_detail_lpj01_pdf as $data => $value_lpj01_pdf) {
                      ?>
                        <?php
                        if ($value_lpj01_pdf == '') {
                        ?>
                          <td style="text-align:center">tidak ada</td>
                        <?php
                        } else if (substr($value_lpj01_pdf, -3) == 'pdf') {
                        ?>
                          <td style="text-align:center"><a href="{{url('backend_admin_download_file',$value_lpj01_pdf)}}" class="btn btn-outline-primary btn-flat"><i class="fas fa-file-pdf"></i></a></td>
                        <?php
                        } else if (substr($value_lpj01_pdf, -4) == 'xlsx') {
                        ?>
                          <td style="text-align:center"><a href="{{url('backend_admin_download_file',$value_lpj01_pdf)}}" class="btn btn-outline-primary btn-flat"><i class="fas fa-file-excel" style="color:green"></i></a></td>
                        <?php
                        }
                        ?>
                      <?php
                      }
                      ?>

                    </tr>

                    <tr>
                      <td>lpj04</td>
                      <?php foreach ($ambil_tb_laporan_detail_lpj04_pdf as $data => $value_lpj04_pdf) {
                      ?>
                        <?php
                        if ($value_lpj04_pdf == '') {
                        ?>
                          <td style="text-align:center">tidak ada</td>
                        <?php
                        } else if (substr($value_lpj04_pdf, -3) == 'pdf') {
                        ?>
                          <td style="text-align:center"><a href="{{url('backend_admin_download_file',$value_lpj04_pdf)}}" class="btn btn-outline-primary btn-flat"><i class="fas fa-file-pdf"></i></a></td>
                        <?php
                        } else if (substr($value_lpj04_pdf, -4) == 'xlsx') {
                        ?>
                          <td style="text-align:center"><a href="{{url('backend_admin_download_file',$value_lpj04_pdf)}}" class="btn btn-outline-primary btn-flat"><i class="fas fa-file-excel" style="color:green"></i></a></td>
                        <?php
                        }
                        ?>
                      <?php
                      }
                      ?>

                    </tr>
                    <tr>
                      <td>Jumlah</td>
                      <?php foreach ($ambil_jumlah_laporan_per_bulan_untuk_grafik as $data => $jumlah_laporan_per_bulan) {
                      ?>
                        <?php
                        if ($jumlah_laporan_per_bulan == 0) {
                        ?>
                          <td style="text-align:center">0</td>
                        <?php
                        } else {
                        ?>
                          <td style="text-align:center"><?php echo $jumlah_laporan_per_bulan . ' valid' ?></td>
                        <?php
                        }
                        ?>
                      <?php
                      }
                      ?>

                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- /.col-md-6 -->

        <!-- /.col-md-6 -->

      </div>

      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection

@section('script')

<script>
  /* global Chart:false */

  $(function() {
    'use strict'

    var ticksStyle = {
      fontColor: '#495057',
      fontStyle: 'bold'
    }

    var mode = 'index'
    var intersect = true

    var grafik_anggran = $('#grafik_anggran')
    // eslint-disable-next-line no-unused-vars
    var grafik_anggran = new Chart(grafik_anggran, {
      data: {
        labels: ['januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        datasets: [{
            type: 'line',
            data: [<?php
                    foreach ($nilai_perencanaan_anggaran_persenan as $data => $value) {
                      echo $value . ",";
                    }
                    ?>],
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            pointBorderColor: '#007bff',
            pointBackgroundColor: '#007bff',
            fill: false
            // pointHoverBackgroundColor: '#007bff',
            // pointHoverBorderColor    : '#007bff'
          },
          {
            type: 'line',
            data: [<?php
                    foreach ($nilai_realisasi_anggaran_persenan as $data => $value) {
                      echo $value . ",";
                    }
                    ?>],
            backgroundColor: 'transparent',
            borderColor: '#ced4da',
            pointBorderColor: '#ced4da',
            pointBackgroundColor: '#ced4da',
            fill: false
            // pointHoverBackgroundColor: '#007bff',
            // pointHoverBorderColor    : '#007bff'
          },
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect
        },
        hover: {
          mode: mode,
          intersect: intersect
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            // display: false,
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks: $.extend({
              beginAtZero: true,
              suggestedMax: 100
            }, ticksStyle)
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            },
            ticks: ticksStyle
          }]
        }
      }
    })




    var grafik_anggran_mari = $('#grafik_anggran_mari')

    // grafik_anggran_mari.height = 200;
    // eslint-disable-next-line no-unused-vars
    var grafik_anggran_mari = new Chart(grafik_anggran_mari, {
      data: {
        labels: ['januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        datasets: [{
            type: 'line',
            data: [<?php
                    foreach ($nilai_perencanaan_anggaran_persenan_mari as $data => $value) {
                      echo $value . ",";
                    }
                    ?>],
            backgroundColor: 'transparent',
            borderColor: '#007bff',
            pointBorderColor: '#007bff',
            pointBackgroundColor: '#007bff',
            fill: false
            // pointHoverBackgroundColor: '#007bff',
            // pointHoverBorderColor    : '#007bff'
          },
          {
            type: 'line',
            data: [<?php
                    foreach ($nilai_realisasi_anggaran_persenan_mari as $data => $value) {
                      echo $value . ",";
                    }
                    ?>],
            backgroundColor: 'transparent',
            borderColor: '#ced4da',
            pointBorderColor: '#ced4da',
            pointBackgroundColor: '#ced4da',
            fill: false
            // pointHoverBackgroundColor: '#007bff',
            // pointHoverBorderColor    : '#007bff'
          },
        ]
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect
        },
        hover: {
          mode: mode,
          intersect: intersect
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks: $.extend({
              beginAtZero: true,
              suggestedMax: 100
            }, ticksStyle)
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            },
            ticks: ticksStyle
          }]
        }
      }
    })



    var grafik_kepatuhan_laporan = $('#grafik_kepatuhan_laporan')
    // eslint-disable-next-line no-unused-vars
    var grafik_kepatuhan_laporan = new Chart(grafik_kepatuhan_laporan, {
      data: {
        labels: ['januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
        datasets: [{
          type: 'line',
          // data: [100, 100, 50, 100, 75, 75, 100, 75, 0, 0, 0, 0],
          data: [

            <?php foreach ($ambil_jumlah_laporan_per_bulan_untuk_grafik as $data => $jumlah_laporan_per_bulan) {
              $jumlah_laporan_per_bulan_double = (float) $jumlah_laporan_per_bulan * 25;
              echo $jumlah_laporan_per_bulan_double . ",";
            } ?>

          ],
          backgroundColor: 'transparent',
          borderColor: '#007bff',
          pointBorderColor: '#007bff',
          pointBackgroundColor: '#007bff',
          fill: false
          // pointHoverBackgroundColor: '#007bff',
          // pointHoverBorderColor    : '#007bff'
        }]
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          mode: mode,
          intersect: intersect
        },
        hover: {
          mode: mode,
          intersect: intersect
        },
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            // display: false,
            gridLines: {
              display: true,
              lineWidth: '4px',
              color: 'rgba(0, 0, 0, .2)',
              zeroLineColor: 'transparent'
            },
            ticks: $.extend({
              beginAtZero: true,
              suggestedMax: 100
            }, ticksStyle)
          }],
          xAxes: [{
            display: true,
            gridLines: {
              display: false
            },
            ticks: ticksStyle
          }]
        }
      }
    })





  })
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