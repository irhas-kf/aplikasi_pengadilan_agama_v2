<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>KEKER</title>
  <link rel="shortcut icon" href="{{ asset('S_Backend/dist/img/pa.png') }}">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('S_Backend/plugins/fontawesome-free/css/all.min.css') }}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ asset('S_Backend/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('S_Backend/dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('S_Backend/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
  <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('S_Backend/plugins/toastr/toastr.min.css') }}">
    <style type="text/css">
      /* Reset. */
body {
  margin: 0;
  background: purple;
}

canvas {
  display: block;
  vertical-align: bottom;
}

/* Particle container. */
#particle-container {
    position: absolute;
    width: 100%;
    height: 100%;
}
    </style>
</head>
<body class="hold-transition login-page">
<div id="particle-container"></div>
<div class="login-box">
  <div class="login-logo">
    <a href="{{ url('/') }}">
      <img style="width: 60%;" src="{{ asset('S_Backend/dist/img/pa.png') }}" alt="Satker">
    </a>
  </div>
  <!-- /.login-logo -->

@yield('content')
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ asset('S_Backend/plugins/jquery/jquery.min.js') }}"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('S_Backend/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('S_Backend/dist/js/adminlte.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/particles.js@2.0.0/particles.min.js"></script>
<script>
  /* ---- particles.js config ---- */

particlesJS("particle-container", {
  "particles": {
    "number": {
      "value": 80,
      "density": {
        "enable": true,
        "value_area": 800
      }
    },
    "color": {
      "value": "random"
    },
    "shape": {
      "type": "circle",
      "stroke": {
        "width": 0,
        "color": "#000000"
      },
      "polygon": {
        "nb_sides": 5
      },
      "image": {
        "src": "img/github.svg",
        "width": 100,
        "height": 100
      }
    },
    "opacity": {
      "value": 0.5,
      "random": false,
      "anim": {
        "enable": false,
        "speed": 1,
        "opacity_min": 0.1,
        "sync": false
      }
    },
    "size": {
      "value": 3,
      "random": true,
      "anim": {
        "enable": false,
        "speed": 40,
        "size_min": 0.1,
        "sync": false
      }
    },
    "line_linked": {
      "enable": false,
      "distance": 150,
      "color": "#ffffff",
      "opacity": 0.4,
      "width": 1
    },
    "move": {
      "enable": true,
      "speed": 1,
      "direction": "none",
      "random": false,
      "straight": false,
      "out_mode": "out",
      "bounce": false,
      "attract": {
        "enable": false,
        "rotateX": 600,
        "rotateY": 1200
      }
    }
  },
  "interactivity": {
    "detect_on": "canvas",
    "events": {
      "onhover": {
        "enable": false,
        "mode": "repulse"
      },
      "onclick": {
        "enable": false,
        "mode": "push"
      },
      "resize": true
    },
    "modes": {
      "grab": {
        "distance": 400,
        "line_linked": {
          "opacity": 1
        }
      },
      "bubble": {
        "distance": 400,
        "size": 40,
        "duration": 2,
        "opacity": 8,
        "speed": 3
      },
      "repulse": {
        "distance": 200,
        "duration": 0.4
      },
      "push": {
        "particles_nb": 4
      },
      "remove": {
        "particles_nb": 2
      }
    }
  },
  "retina_detect": true
});
</script>
</body>
</html>
