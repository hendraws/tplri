<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('vendors/UserUI/assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('vendors/UserUI/assets/img/logoKino.png') }}"">
  <meta http-equiv=" X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        LOGIN | CAT IKDIN
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
    <style type="text/css">
        .page-header .page-header-image {
            z-index: 0 !important;
        }

    </style>

</head>

<body class="login-page sidebar-collapse">
    <div class="page-header clear-filter" filter-color="#">
        <div class="page-header-image" style="background-image:url('{{ asset('images/bg3.png') }}"
            style="opacity: 0.8 !important;"></div>
        <div class="content">
            <div class="container">
                <div class="col-md-4">
                    <div class="card card-login"
                        style="border-radius: 40px !important; padding: 20px; background-color: #fffffff8 !important;">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
                            <div class="card-header text-center" style="margin-bottom: -20px; margin-top: 10px;">
                                <div class="logo-container">
                                    <img src="{{ asset('vendors/UserUI/assets/img/logoKino.png') }}" alt=""
                                        style="border: 1px solid #f96332d4; border-radius: 50px;">
                                </div>
                            </div>
                            <div class="card-body" style="padding: 0px !important;">
                                <div class="row">
                                    <div class="col-md-12 col-sm">
                                        <div class="alert alert-danger alert-dismissible"
                                            style="padding: 0px !important;">
                                            <ul>
                                                @if ($errors->any())
                                                    {!! implode('', $errors->all('<li>:message</li>')) !!}
                                                @endif

                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="input-group no-border input-lg">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="now-ui-icons users_circle-08"></i>
                                        </span>
                                    </div>
                                    {{-- <input type="text" name="USERNAME" id="USERNAME" class="form-control" placeholder="Username" required> --}}
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" required autocomplete="email" autofocus
                                        placeholder="Email">
                                </div>
                                <div class="input-group no-border input-lg">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i class="now-ui-icons objects_key-25"></i>
                                        </span>
                                    </div>
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        required autocomplete="current-password" placeholder="Pasword">
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <input type="submit" name="login" value="Login"
                                    class="btn btn-primary btn-round btn-lg btn-block">
                                <span style="color: black;"> Belum memiliki akun ?</span> <a href="{{ action([App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm']) }}">Registrasi</a>
                            </div>
                        </form>
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

                <a href="">Rumah Private Kino</a>, Template By Now UI Kit. </strong>
                Coded by <a href="https://www.instagram.com/hendrawijayas_/">WijayaTech</a>.
            </div>

        </div>
    </footer>
    </div>
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
