<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('vendors/UserUI/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('vendors/UserUI/assets/img/logoKino.png') }}"">
  <meta http-equiv=" X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        REGISTRASI | Simulasi CAT
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- CSS Files -->
    <link href="{{ asset('vendors/UserUI/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendors/UserUI/assets/css/now-ui-kit.css?v=1.3.0') }}" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="{{ asset('vendors/UserUI/assets/demo/demo.css') }}" rel="stylesheet" />
</head>

<body class="login-page sidebar-collapse">

    <?php date_default_timezone_set('Asia/Jakarta'); ?>

    <style type="text/css">
        .option_css {
            color: #495057 !important;
            background-color: #fff !important;
        }

        .page-header .page-header-image {
            z-index: 0 !important;
        }

        .page-header {
            max-height: 1200px !important;
        }

    </style>

    <div class="page-header clear-filter">
        <div class="page-header-image" style="background-image:url('{{ asset('images/bg3.png') }}"
            style="opacity: 0.8 !important;"></div>
        <div class="content" style="margin: 0px !important;">
            <div class="" style="margin-top: 2%;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="card card-login"
                            style="margin-top: 100px; max-width: 600px !important; border-radius: 40px !important; padding: 20px; background-color: #fffffff8 !important;">

                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="card-header text-center">
                                            <div class="logo-container">
                                                <img src="{{ asset('vendors/UserUI/assets/img/logoKino.png') }}"
                                                    alt="" style="border: 1px solid #f96332d4; border-radius: 50px;">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card-body" style="padding: 0px !important; margin-top : -5%;">

                                            <div class="form-row">
                                                <div class="form-group col-md-12 no-border input-lg">
                                                    <input id="name" type="text"
                                                        class="form-control @error('name') is-invalid @enderror"
                                                        name="name" value="{{ old('name') }}" required
                                                        autocomplete="name" autofocus placeholder="name">
                                                </div>
                                                <div class="form-group col-md-12 no-border input-lg">
                                                    <input id="email" type="email"
                                                        class="form-control @error('email') is-invalid @enderror"
                                                        name="email" value="{{ old('email') }}" required
                                                        autocomplete="email" placeholder="Email">
                                                </div>
                                                <div class="form-group col-md-12 no-border input-lg">
                                                    <input id="password" type="password" placeholder="Password"
                                                        class="form-control @error('password') is-invalid @enderror"
                                                        name="password" required autocomplete="new-password">
                                                </div>
                                                <div class="form-group col-md-12 no-border input-lg">
                                                    <input id="password-confirm" type="password" placeholder="Retype password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="card-footer text-center">
                                            <input type="submit" name="simpan"
                                                class="btn btn-primary btn-round btn-lg btn-block" value="Daftar">
                                            <span style="color: black;">Sudah memiliki akun ?</span> <a
                                                href="{{ route('login') }}">Login</a>
                                        </div>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <footer class="footer">
        <div class=" container " style="text-align: center;">
            <div id="copyright">
                &copy;
                <script>
                    document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
                </script>

                <a href="/">Rumah Private Kino</a>, Template By Now UI Kit. </strong>
                Coded by <a href="https://www.instagram.com/knighturnal/">Knighturnal</a>.
            </div>

        </div>
    </footer>
    </div>
    <!--   Core JS Files   -->

    <!--   Core JS Files   -->
    <script src="{{ asset('vendors/UserUI/assets/js/core/jquery.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/UserUI/assets/js/core/popper.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('vendors/UserUI/assets/js/core/bootstrap.min.js') }}" type="text/javascript"></script>
    <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
    <script src="{{ asset('vendors/UserUI/assets/js/plugins/bootstrap-switch.js') }}"></script>
    <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
    <script src="{{ asset('vendors/UserUI/assets/js/plugins/nouislider.min.js') }}" type="text/javascript"></script>
    <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
    <script src="{{ asset('vendors/UserUI/assets/js/plugins/bootstrap-datepicker.js') }}" type="text/javascript">
    </script>
    <!--  Google Maps Plugin    -->
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script> --}}
    <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('vendors/UserUI/assets/js/now-ui-kit.js?v=1.3.0') }}" type="text/javascript"></script>

</body>

</html>
