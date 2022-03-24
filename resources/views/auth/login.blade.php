@extends('layouts.app')

@section('content')
<div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg">
          <img width="100%" src="{{ asset('S_Backend/dist/img/satker.png') }}">
        </p>

        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div class="input-group mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
                @error('email')
                <p class="btn btn-warning" role="alert">
                  {{ $message }}
                </p>
                @enderror
            </div>

            <div class="input-group mb-3">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
                @error('password')
                <p class="btn btn-warning" role="alert">
                  {{ $message }}
                </p>
                @enderror
            </div>

            <div class="row">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label for="remember">
                            Remember Me
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>

        <p class="mb-1">
            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}">I forgot my password</a>
            @endif
        </p>
<!-- <p class="mb-0">
<a href="register.html" class="text-center">Register a new membership</a>
</p> -->
</div>
<!-- /.login-card-body -->
</div>
@endsection
