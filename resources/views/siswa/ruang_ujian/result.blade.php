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

<body class="hold-transition" style="background-color: #FFEAAD;">
    <div class="container">
        <h1 class="text-center">RESULT CAT IKDIN RUMAH PRIVATE KINO</h1>
        <div class="row mt-5 justify-content-md-center">
            <div class="col-md-12">
                <div class="card">
                    {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                    <div class="card-body ">
                        <a href="{{ '/' }}" class="btn btn-warning col-12 mt-2">Kembali Ke
                            Beranda</a>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Soal</th>
                                        <th scope="col">Jawaban</th>
                                        <th scope="col">Skor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data->getJawaban as $value)
                                        <tr>
                                            <th scope="row">{{ $loop->index + 1 }}</th>
                                            <td>{!! optional($value->getSoal)->pertanyaan !!}</td>
                                            <td>{!! optional($value->getJawaban)->jawaban !!}</td>
                                            <td>{{ $value->skor }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <a href="{{ '/' }}" class="btn btn-warning col-12 mt-2">Kembali Ke
                            Beranda</a>
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
