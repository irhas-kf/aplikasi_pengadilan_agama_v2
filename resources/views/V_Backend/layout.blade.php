<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{csrf_token()}}">
  <title>Pengadilan Agama Terenggalek</title>
  <link rel="shortcut icon" href="{{ asset('S_Backend/dist/img/pa.png') }}">
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('S_Backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('S_Backend/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('S_Backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('S_Backend/plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('S_Backend/dist/css/adminlte.min.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('S_Backend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('S_Backend/plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('S_Backend/plugins/summernote/summernote-bs4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('S_Backend/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('S_Backend/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">

  <link rel="stylesheet" href="{{ asset('S_Backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('S_Backend/plugins/toastr/toastr.min.css') }}">

  <style>
    /*Profile Pic Start*/
    .picture-container {
      position: relative;
      cursor: pointer;
      text-align: center;
    }

    .picture {
      width: 150px;
      height: 150px;
      background-color: #999999;
      border: 4px solid #CCCCCC;
      color: #FFFFFF;
      border-radius: 50%;
      margin: 0px auto;
      overflow: hidden;
      transition: all 0.2s;
      -webkit-transition: all 0.2s;
    }

    .picture:hover {
      border-color: #2ca8ff;
    }

    .content.ct-wizard-green .picture:hover {
      border-color: #05ae0e;
    }

    .content.ct-wizard-blue .picture:hover {
      border-color: #3472f7;
    }

    .content.ct-wizard-orange .picture:hover {
      border-color: #ff9500;
    }

    .content.ct-wizard-red .picture:hover {
      border-color: #ff3b30;
    }

    .picture input[type="file"] {
      cursor: pointer;
      display: block;
      height: 100%;
      left: 0;
      opacity: 0 !important;
      position: absolute;
      top: 0;
      width: 100%;
    }

    .picture-src {
      width: 100%;
    }

    .field-icon {
      float: right;
      margin-left: -25px;
      margin-top: -25px;
      position: relative;
      z-index: 2;
    }

    /* .container {
      padding-top: 50px;
      margin: auto;
    } */
  </style>

  @yield('stylecss')

</head>

<body class="hold-transition sidebar-mini layout-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    @include('V_Backend.navbar')
    <!-- End Navbar -->

    <!-- Main Sidebar Container -->

    <!-- End Main Sidebar Container -->

    <!-- Content -->
    @yield('konten')
    <!-- End Content -->

    <!-- Main Sidebar Container -->
    @include('V_Backend.footer')
    <!-- End Main Sidebar Container -->

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
  </div>
  <!-- ./wrapper -->

  <!-- jQuery -->



  <script src="{{ asset('S_Backend/plugins/jquery/jquery.min.js') }}"></script>
  <!-- jQuery UI 1.11.4 -->
  <script src="{{ asset('S_Backend/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
  <script>
    $.widget.bridge('uibutton', $.ui.button)
  </script>
  <!-- Bootstrap 4 -->
  <script src="{{ asset('S_Backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- ChartJS -->
  <script src="{{ asset('S_Backend/plugins/chart.js/Chart.min.js') }}"></script>
  <!-- Sparkline -->
  <script src="{{ asset('S_Backend/plugins/sparklines/sparkline.js') }}"></script>
  <!-- JQVMap -->
  <script src="{{ asset('S_Backend/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
  <script src="{{ asset('S_Backend/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
  <!-- jQuery Knob Chart -->
  <script src="{{ asset('S_Backend/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
  <!-- daterangepicker -->
  <script src="{{ asset('S_Backend/plugins/moment/moment.min.js') }}"></script>
  <script src="{{ asset('S_Backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
  <!-- Tempusdominus Bootstrap 4 -->
  <script src="{{ asset('S_Backend/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
  <!-- Summernote -->
  <script src="{{ asset('S_Backend/plugins/summernote/summernote-bs4.min.js') }}"></script>
  <!-- overlayScrollbars -->
  <script src="{{ asset('S_Backend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
  <!-- AdminLTE App -->
  <script src="{{ asset('S_Backend/dist/js/adminlte.js') }}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{ asset('S_Backend/dist/js/demo.js') }}"></script>
  <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
  <!-- <script src="{{ asset('S_Backend/dist/js/pages/dashboard3.js') }}"></script> -->

  <!-- DataTables -->
  <script src="{{ asset('S_Backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('S_Backend/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('S_Backend/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
  <script src="{{ asset('S_Backend/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>

  <script src="{{ asset('S_Backend/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

  <script src="{{ asset('S_Backend/plugins/sweetalert2/sweetalert2.min.js') }}"></script>
  <script src="{{ asset('S_Backend/plugins/toastr/toastr.min.js') }}"></script>


  @yield('script')

  <script>
    $('#modal_profile').on('hidden.bs.modal', function() {
      location.reload();
    });
  </script>

  <!-- untuk set data profile di modal open_modal_profile, form berada di (navabar.balde.php) -->
  <script>
    $(document).on('click', '.open_modal_profile', function() {
      var url = "backend_profile";
      var id_laporan = $(this).val();
      $.get(url, function(data) {

        var data = JSON.parse(data);
        console.log(data);

        
        document.getElementById("id_user_profile").value = data[0];
        document.getElementById("nama_user_profile").value = data[1];
        document.getElementById("email_user_profile").value = data[2];
        document.getElementById("level_user_profile").value = data[3];
        // {{ asset('image/photo_profile/'.Auth::user()->photo_profile) }}
        document.getElementById("photo_user_profile").src = "{{URL::asset('image/photo_profile/')}}/"+data[4];
        
      })
    });
  </script>


  <!-- untuk preview photo profile di modal open_modal_profile, form berada di (navabar.balde.php) -->
  <script>
    $(document).ready(function() {
      // Prepare the preview for profile picture
      $("#wizard_photo_user_profile").change(function() {
        readURL(this);
      });
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#photo_user_profile').attr('src', e.target.result).fadeIn('slow');
        }
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>


  <!-- untuk menyimpan update data jika di tekan button yang ber id='btnSave', form berada di (navabar.balde.php) -->

  <script type="text/javascript">
    $(document).ready(function() {
      $('#btnSave').click(function(e) {

        
        $(this).html("Proses...")

        // https://mkyong.com/jquery/jquery-ajax-submit-a-multipart-form/
        event.preventDefault();
        var form = $('#formProfile')[0];
        var data = new FormData(form);

        $.ajax({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: data,
          enctype: 'multipart/form-data',
          processData: false, // Important!
          contentType: false,
          cache: false,
          url: "{{ route('update_backend_profile') }}",
          type: "POST",
          dataType: 'json',
          success: function(data) {

            // $('#formProfile').trigger('reset');

            var response_ajax_update_profile = data['response_ajax_update_profile'];
            // console.log(response_ajax_update_profile);
            if (response_ajax_update_profile == 'success') {
              toastr.success("anda berhasil update profile");
            } else if (response_ajax_update_profile == 'failure_password_lama') {
              toastr.warning("password lama anda salah");
            } else if (response_ajax_update_profile == 'failure_password_baru') {
              toastr.warning("password lama anda benar, tetapi anda belum memasukan password baru");
            }

            document.getElementById("password_lama_profile").value = '';
            document.getElementById("password_baru_profile").value = '';

            $('#btnSave').html("Save changes")

            // $('#tmb_usulan').modal('hide');
            // location.reload(true);
            // tabel.ajax.reload();
          },
          error: function(data) {
            console.log('Error:', data);
            //$('#modalPenghargaan').modal('show');
          }
        });
      });

    });
  </script>

  <!-- untuk show hide input type password di form profile -->
  <script>
    $(".toggle-password-baru").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      // var input = $($(this).attr("toggle"));
      var input = $("#password_baru_profile");
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });

    $(".toggle-password-lama").click(function() {

      $(this).toggleClass("fa-eye fa-eye-slash");
      // var input = $($(this).attr("toggle"));
      var input = $("#password_lama_profile");
      if (input.attr("type") == "password") {
        input.attr("type", "text");
      } else {
        input.attr("type", "password");
      }
    });
  </script>

</body>

</html>