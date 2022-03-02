@extends('layouts.app')

@section('content')
    <div id="slideBg"></div>
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-warning">
            <div class="card-header text-center">
                <div class="row  justify-content-center">
                    <a href="/">
                    <div class="col-12text-center">
                        <img src="{{ asset('images/polri.png') }}" alt="Rumah Private Kino" class="cover p-2">
                        <img src="{{ asset('images/polda.png') }}" alt="Rumah Private Kino" class="cover p-2">
                        <img src="{{ asset('images/bg.png') }}" alt="Rumah Private Kino" class="cover p-2" >
                    </div>
                    </a>
                </div>
            </div>
            <div class="card-body">
                <h5 class="text-center">Test Psikologi Polri</h5>
                <p class="login-box-msg">Login</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group mb-3">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Pasword">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="row">
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mt-2">
                    Belum mempunyai Akun ? <a href="{{ action([App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm']) }}" class="text-center">Register</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
@endsection
