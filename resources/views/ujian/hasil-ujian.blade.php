<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>KINO CAT</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/toastr/toastr.min.css') }}">
    @toastr_css
    <style>
        .cover {
            object-fit: cover;
            height: 80px;
        }

    </style>

</head>

<body class="hold-transition login-page" style="background: #ffb236">

    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <div class="row  justify-content-center">
                    <a href="/">
                        <div class="col-12 text-center">
                            <img src="{{ asset('images/polri.png') }}" alt="Rumah Private Kino" class="cover p-2">
                            <img src="{{ asset('images/polda.png') }}" alt="Rumah Private Kino" class="cover p-2">
                            <img src="{{ asset('images/bg.png') }}" alt="Rumah Private Kino" class="cover p-2">
                        </div>
                    </a>
                </div>
            </div>
            <div class="card-body">
              <h5>Nilai Test Psikologi</h5>
              <h1 class="border text-center p-3">
                  {{ floor(optional($data->getNilai)->nilai_akhir) }}
              </h1>

              <h4 class="border text-center p-3">
                  @if(floor(optional($data->getNilai)->nilai_akhir) >= 58)
                  Memenuhi Syarat
                  @else
                  Tidak Memenuhi Syarat
                  @endif
              </h4>
              <a href="/" class="btn btn-primary btn-sm col-12">Kembali Ke Beranda</a>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendors/toastr/toastr.min.js') }}"></script>
    @toastr_js
    @toastr_render
    <script>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
    </script>
</body>

</html>
