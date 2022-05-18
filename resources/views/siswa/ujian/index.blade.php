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
    <link rel="stylesheet" href="{{ asset('vendors/slider/dist/assets/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/slider/dist/assets/owl.theme.default.min.css') }}">
    @toastr_css
    <style>
        .cover {
            object-fit: cover;
            height: 80px;
        }

        .carousel-inners img {
            width: 100%;
            height: 100%;
        }

        #demo {
            position: absolute;
            z-index: -1;
        }

        .tengah {

            margin: auto;
            width: 50%;

            padding: 10px;

        }

        .login-pages {
            font-family: arial;
            font-size: 24px;
            /* margin: 25px; */
            height: 100%;
            outline: dashed 1px black;
            /* Setup */
            position: relative;
        }


        .fixed-height {
            max-height: 400px;
        }

        html {
            height: 100vh !important;
        }

        body {
            min-height: 100vh !important;
        }

        .bawah {
            position: absolute;
            bottom: 0;
        }

    </style>

</head>

<body class="hold-transition login-pages" style="background: #FFEAAD">

    <!-- The slideshow -->
    <div class="owl-carousel" id="demo">
        <div><img src="{{ asset('images/slider/1.png') }}" alt=""></div>
        <div><img src="{{ asset('images/slider/2.png') }}" alt=""></div>
        <div><img src="{{ asset('images/slider/3.png') }}" alt=""></div>
        <div><img src="{{ asset('images/slider/4.png') }}" alt=""></div>
        <div><img src="{{ asset('images/slider/5.png') }}" alt=""></div>
        <div><img src="{{ asset('images/slider/6.png') }}" alt=""></div>
        <div><img src="{{ asset('images/slider/7.png') }}" alt=""></div>
        <div><img src="{{ asset('images/slider/8.png') }}" alt=""></div>
        <div><img src="{{ asset('images/slider/9.png') }}" alt=""></div>
        <div><img src="{{ asset('images/slider/10.png') }}" alt=""></div>
    </div>


    <div id="frontpage" class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
        <!-- /.login-logo -->
        <div class="row align-center">
            <div class="col-md-12">
                <div class="card card-outline card-primary">
                    <div class="card-header text-center">
                        <div class="row  justify-content-center">
                            <a href="/">
                                <div class="col-12 text-center">
                                    <img src="{{ asset('images/ssdikdin.png') }}" alt="Rumah Private Kino"
                                        class="cover p-2">
                                    {{-- <img src="{{ asset('images/polda.png') }}" alt="Rumah Private Kino"
                                        class="cover p-2"> --}}
                                    <img src="{{ asset('images/bg.png') }}" alt="Rumah Private Kino"
                                        class="cover p-2">
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ action('IkdinUjianSiswaController@cekToken') }}">
                            @csrf
                            <div class="input-group mb-3">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        Token
                                    </div>
                                </div>
                                <input id="token" type="text" class="form-control @error('token') is-invalid @enderror"
                                    name="token" value="{{ old('token') }}" required autocomplete="token" autofocus
                                    placeholder="token">
                            </div>
                            <div class="row">
                                <!-- /.col -->
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary btn-block">Mulai Ujian</button>
                                    <a href="/" class="btn btn-secondary btn-block">Kembali</a>
                                </div>
                                <!-- /.col -->
                            </div>
                        </form>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>

        <!-- /.card -->
    </div>

    {{-- <div class="owl-carousel bawah">
        <div><img src="{{ asset('images/slider/6.png') }}"  alt=""></div>
        <div><img src="{{ asset('images/slider/7.png') }}"  alt=""></div>
        <div><img src="{{ asset('images/slider/8.png') }}"  alt=""></div>
        <div><img src="{{ asset('images/slider/9.png') }}"  alt=""></div>
        <div><img src="{{ asset('images/slider/10.png') }}"  alt=""></div>
    </div> --}}
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script src="{{ asset('plugins/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('vendors/toastr/toastr.min.js') }}"></script>
    <script src="{{ asset('vendors/slider/dist/owl.carousel.min.js') }}"></script>
    @toastr_js
    @toastr_render
    <script>
        @if (count($errors) > 0)
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif
        $(document).ready(function() {
            $(".owl-carousel").owlCarousel({
                items: 2,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                    },
                    600: {
                        items: 2,
                    },
                    1000: {
                        items: 2,
                    }
                },
                loop: true,
                // margin:10,
                autoplay: true,
                autoplayTimeout: 3000,
                autoplayHoverPause: true
            });
        });
    </script>
</body>

</html>
