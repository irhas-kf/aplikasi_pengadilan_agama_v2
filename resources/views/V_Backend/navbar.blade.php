<nav class="main-header navbar navbar-expand navbar-purple navbar-light">
  <!-- Left navbar links -->
  <!-- SEARCH FORM -->
  <!-- Right navbar links -->
  <ul class="navbar-nav">
    <li class="nav-item">
      <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
    </li>
  </ul>

  <ul class="navbar-nav">
    <li class="nav-item">
      @if(Auth::user()->level == 'admin')
      @if(Session::has('filter_data_tahun_admin'))
      {{ Session::get('filter_data_tahun_admin')}}
      @endif
      @endif

      @if(Auth::user()->level == 'pimpinan')
      @if(Session::has('filter_data_tahun_pimpinan'))
      {{ Session::get('filter_data_tahun_pimpinan')}}
      @endif
      @endif

      @if(Auth::user()->level == 'operator')
      @if(Session::has('filter_data_tahun_operator'))
      {{ Session::get('filter_data_tahun_operator')}}
      @endif
      @endif
    </li>
  </ul>

  <ul class="navbar-nav navbar-yellow ml-auto">
    <li class="nav-item dropdown">

      <a class="nav-link" data-toggle="dropdown" href="#">
        <i class="fas fa-user"></i>
        <!-- <img src="{{ asset('S_Backend/dist/img/avatar.png') }}" class="img-circle elevation-2" alt="User Image" style="width: 30px; height: 30px"> -->
      </a>
      <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <span class="dropdown-item dropdown-header">Setting Akun</span>
        <div class="dropdown-divider"></div>

        <!-- javascript ajax open_modal_profile ada di file V_Backend/layout.blade.php -->
        <button class="dropdown-item open_modal_profile" data-toggle="modal" data-target="#modal_profile">
          <i class="fas fa-user-edit"></i> Profil
        </button>
        <div class="dropdown-divider"></div>

        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
          <i class="fas fa-sign-out-alt"></i> Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
        <div class="dropdown-divider"></div>
      </div>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
        <i class="fas fa-th-large"></i>
      </a>
    </li> -->
  </ul>

</nav>


<div class="modal fade" id="modal_profile">
  <div class="modal-dialog modal-md modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Profile</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" name="formProfile" id="formProfile" enctype="multipart/form-data">
          @csrf
          <!-- @csrf_field -->
          <div class="card-body">

            <div class="form-group row">
              <div class="container">
                <div class="picture-container">
                  <div class="picture">
                    <img class="picture-src" name="photo_user_profile" id="photo_user_profile" title="">
                    <input type="file" name="wizard_photo_user_profile" id="wizard_photo_user_profile" class="">
                  </div>
                </div>
              </div>
            </div>

            <!-- <input type="file" name="wizard_photo_user_profile" id="wizard_photo_user_profile" class=""> -->

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Nama</label>
              <div class="col-sm-10">
                <input type="hidden" class="form-control" id="id_user_profile" name="id_user_profile" placeholder="id user">
                <input type="text" class="form-control" id="nama_user_profile" name="nama_user_profile" placeholder="nama user">
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Email</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="email_user_profile" name="email_user_profile" placeholder="email user">
              </div>
            </div>

            <div class="form-group row">
              <label for="inputEmail3" class="col-sm-2 col-form-label">Level</label>
              <div class="col-sm-10">
                <input readonly="readonly" type="text" class="form-control" id="level_user_profile" name="level_user_profile" placeholder="level user">
              </div>
            </div>

            <div class="card card-primary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Edit Password</h3>
                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-5 col-form-label">Password Lama</label>
                  <div class="col-sm-7">
                    <!-- <input type="password" class="form-control" id="password_lama_profile" name="password_lama_profile" placeholder="password lama"> -->
                    <input type="password" id="password_lama_profile" name="password_lama_profile" class="form-control" placeholder="password lama">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password-lama"></span>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-5 col-form-label">Password Baru</label>
                  <div class="col-sm-7">
                    <!-- <input type="password" class="form-control" id="password_baru_profile" name="password_baru_profile" placeholder="password baru"> -->
                    <input type="password" id="password_baru_profile" name="password_baru_profile" class="form-control" placeholder="password lama">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password-baru"></span>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>

          </div>
          <!-- /.card-footer -->
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" id="btnSave" class="btn btn-primary">Save changes</button>
      </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>