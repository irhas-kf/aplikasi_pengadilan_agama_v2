<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ url('/backend_operator_dashboard') }}" class="brand-link">
    <img style="width: 90%;" src="{{ asset('S_Backend/dist/img/satkerdsb.png') }}" alt="Satker">
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{ asset('image/photo_profile/'.Auth::user()->photo_profile) }}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ url('/backend_operator_dashboard') }}" class="d-block">
          <?php
          $level = Auth::user()->name;
          $kalimat_new = strtoupper($level);
          echo $kalimat_new;
          ?>
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
          <a href="{{ url('/backend_operator_dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Dashboard
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/backend_operator_laporan') }}" class="nav-link">
            <i class="nav-icon fas fa-file-pdf"></i>
            <p>
              Kepatuhan Laporan
            </p>
          </a>
        </li>
        <li class="nav-item">
          <a href="{{ url('/backend_operator_filter_data') }}" class="nav-link">
            <i class="nav-icon fas fa-filter"></i>
            <p>
              Filter Data
            </p>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>