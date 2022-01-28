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
        .login-box {
            width: 500px;
        }

    </style>
</head>

<body class="hold-transition login-page" style="background: #ffb236">

    <div class="login-box">
        <!-- /.login-logo -->
        <form action="{{ action('UjianSiswaController@mulaiUjian') }}" id="formUjian" method="post">
            @csrf
            <div class="card card-outline card-primary">
                <div class="card-header text-center m-0 ">
                    <h5>
                        Ujian Computer Assisted Test (CAT) <br>
                        Rumah Private Kino
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-4">Nama</div>
                        <div class="col-8">: {{ auth()->user()->name }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4">Judul Ujian</div>
                        <div class="col-8">: {{ $pengaturanUjian->judul }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4">Program Akademik</div>
                        <div class="col-8">: {{ $pengaturanUjian->getProgramAkademik->nama_program }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4">Kelas</div>
                        <div class="col-8">: {{ $pengaturanUjian->getKelas->nama_kelas }}</div>
                    </div>
                    <div class="row">
                        <div class="col-4">Durasi</div>
                        <div class="col-8">: {{ $pengaturanUjian->durasi }}</div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <input type="hidden" name="ujian" value="{{ $pengaturanUjian->id }}" >
                            <input type="hidden" name="ujianSiswa" value="{{ $cekUjian->id }}" >
                            <button class="btn btn-primary col-12" id="mulai">Mulai Ujian</button>
                            <a href="{{ url('/') }}" class="btn btn-secondary col-12 mt-2">Kembali Ke Beranda</a>
                        </div>
                    </div>

                </div>
            </form>
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
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '#mulai', function(e) {
                e.preventDefault();
                var form = $('#formUjian');
                var id = $(this).data('id');
                var url = '{{ action('ProgramAkademikController@destroy', ':id') }}';
                url = url.replace(':id', id);
                Swal.fire({
                    title: 'Mulai Ujian ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, Mulai Ujian!'
                }).then((result) => {
                    if (result.value == true) {
                        $('#formUjian').submit();

                    }
                })
            }) //tutup
        });
    </script>
</body>

</html>
