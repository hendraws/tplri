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
        body {
            height: 100vh !important;
        }

    </style>

</head>

<body class="hold-transition login-page" style="background-color: #FFEAAD;">
    <div class="container ">
        <h1 class="text-center">Test Psikologi Polri Rumah Private Kino</h1>
        <div class="row mt-5">
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                    <div class="card-body ">
                        <form method="POST" action="{{ action('UjianSiswaController@ujianKecerdasan') }}">
                            @csrf
                            <h5 class=" text-center">Test Kecerdasan</h5>
                            <input type="hidden" name="ujian_id" value="{{ $ujianSiswa->ujian_id }}">
                            <input type="hidden" name="ujian_siswa_id" value="{{ $ujianSiswa->id }}">
                            {{-- <button class="btn btn-secondary col-12 mt-4" disabled>Test Belum Tersedia</button> --}}
                            @if($ujianSiswa->kecerdasan == 0)
                            <button type="submit" class="btn btn-primary col-12 mt-4" onclick="return confirm('Mulai Test kecerdasan ?')">Mulai Test</button>
                            @elseIf($ujianSiswa->kecerdasan == 1)
                            <button class="btn btn-success col-12 mt-4" disabled>Selesai Test</button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                    <div class="card-body">
                        <form method="POST" action="{{ action('UjianSiswaController@ujianKecermatan') }}">
                            @csrf
                        <h5 class="text-center">Test Kecermatan</h5>
                        <input type="hidden" name="ujian_id" value="{{ $ujianSiswa->ujian_id }}">
                        <input type="hidden" name="ujian_siswa_id" value="{{ $ujianSiswa->id }}">
                        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk
                            of the card's content.</p> --}}
                        @if($ujianSiswa->kecermatan == 0 && $ujianSiswa->kecerdasan == 0)
                        <button class="btn btn-secondary col-12 mt-4" disabled>Test Belum Tersedia</button>
                        @elseif($ujianSiswa->kecerdasan == 1 && $ujianSiswa->kecermatan == 0)
                        <button type="submit"   class="btn btn-primary col-12 mt-4" onclick="return confirm('Mulai Ujian?')">Mulai Test</button>
                        @elseIf($ujianSiswa->kecermatan == 1 &&  $ujianSiswa->kecerdasan == 1)
                        <button class="btn btn-success col-12 mt-4" disabled>Selesai Test</button>
                        @endif

                    </form>
                    </div>
                </div>
            </div>
            <div class="col-4">
                <div class="card" style="width: 18rem;">
                    {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                    <div class="card-body">
                        <form method="POST" action="{{ action('UjianSiswaController@ujianKepribadian') }}">
                            @csrf
                        <h5 class="text-center">Test Kepribadian</h5>
                        <input type="hidden" name="ujian_id" value="{{ $ujianSiswa->ujian_id }}">
                        <input type="hidden" name="ujian_siswa_id" value="{{ $ujianSiswa->id }}">
                        {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk
                            of the card's content.</p> --}}
                        @If($ujianSiswa->kecermatan == 1 &&  $ujianSiswa->kecerdasan == 1 && $ujianSiswa->kepribadian  == 0 )
                        <button type="submit"   class="btn btn-primary col-12 mt-4" onclick="return confirm('Mulai Ujian?')">Mulai Test</button>
                        @elseif($ujianSiswa->kepribadian  == 0)
                        <button class="btn btn-secondary col-12 mt-4" disabled>Test Belum Tersedia</button>
                        @endif
                    </form>
                    </div>
                </div>
            </div>
        </div>
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
