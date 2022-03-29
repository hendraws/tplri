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
        <h1 class="text-center">CAT AKADEMIK POLRI {{ strtoupper($ujian->posisi) }} RUMAH PRIVATE KINO</h1>

        <div class="row mt-5 justify-content-md-center">

            <div class="col-md-3">
                <div class="card">
                    {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                    <div class="card-body ">
                        <form method="POST" action="{{ action('AkademikUjianSiswaController@halamanUjian') }}">
                            @csrf
                            <h5 class=" text-center">Matematika</h5>
                            <input type="hidden" name="ujian_id" value="{{ $ujianSiswa->ujian_id }}">
                            <input type="hidden" name="ujian_siswa_id" value="{{ $ujianSiswa->id }}">
                            <input type="hidden" name="mapel" value="mtk">
                            <input type="hidden" name="waktu" value="90">
                            <input type="hidden" name="jumlah_soal" value="40">
                            {{-- <button class="btn btn-secondary col-12 mt-4" disabled>Test Belum Tersedia</button> --}}
                            @if ($ujianSiswa->mtk == 0)
                                <button type="submit" class="btn btn-primary col-12 mt-4"
                                    onclick="return confirm('Mulai Test Matematika ?')">Mulai Ujian</button>
                            @elseIf($ujianSiswa->mtk == 1)
                                <button class="btn btn-secondary col-12 mt-4" disabled>NILAI UJIAN <br> MATEMATIKA <br>
                                    <h1>{{ optional($ujianSiswa->getNilai)->mtk }}</h1>
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                    <div class="card-body ">
                        <form method="POST" action="{{ action('AkademikUjianSiswaController@halamanUjian') }}">
                            @csrf
                            <h5 class=" text-center">Wawasan Kebangsaan</h5>
                            <input type="hidden" name="ujian_id" value="{{ $ujianSiswa->ujian_id }}">
                            <input type="hidden" name="ujian_siswa_id" value="{{ $ujianSiswa->id }}">
                            <input type="hidden" name="mapel" value="wk">
                            <input type="hidden" name="jumlah_soal" value="50">
                            <input type="hidden" name="waktu" value="90">
                            {{-- <button class="btn btn-secondary col-12 mt-4" disabled>Test Belum Tersedia</button> --}}
                            @if ($ujianSiswa->wk == 0)
                                <button type="submit" class="btn btn-primary col-12 mt-4"
                                    onclick="return confirm('Mulai Test Wawasan Kebangsaan ?')">Mulai Ujian</button>
                            @elseIf($ujianSiswa->wk == 1)
                                <button class="btn btn-secondary col-12 mt-4" disabled>NILAI UJIAN WAWASAN
                                    KEBANGSAAN
                                    <h1>{{ optional($ujianSiswa->getNilai)->wk }}</h1>
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                    <div class="card-body ">
                        <form method="POST" action="{{ action('AkademikUjianSiswaController@halamanUjian') }}">
                            @csrf
                            <h5 class=" text-center">Pengetahuan Umum</h5>
                            <input type="hidden" name="ujian_id" value="{{ $ujianSiswa->ujian_id }}">
                            <input type="hidden" name="ujian_siswa_id" value="{{ $ujianSiswa->id }}">
                            <input type="hidden" name="mapel" value="pu">
                            <input type="hidden" name="waktu" value="90">
                            <input type="hidden" name="jumlah_soal" value="50">
                            {{-- <button class="btn btn-secondary col-12 mt-4" disabled>Test Belum Tersedia</button> --}}
                            @if ($ujianSiswa->pu == 0)
                                <button type="submit" class="btn btn-primary col-12 mt-4"
                                    onclick="return confirm('Mulai Test Pengetahuan Umum ?')">Mulai Ujian</button>
                            @elseIf($ujianSiswa->pu == 1)
                                <button class="btn btn-secondary col-12 mt-4" disabled>NILAI UJIAN PENGETAHUAN
                                    UMUM
                                    <h1>{{ optional($ujianSiswa->getNilai)->pu }}</h1>
                                </button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            @if ($ujian->posisi == 'bintara')
                <div class="col-md-3">
                    <div class="card">
                        {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                        <div class="card-body ">
                            <form method="POST" action="{{ action('AkademikUjianSiswaController@halamanUjian') }}">
                                @csrf
                                <h5 class=" text-center">Bahasa Inggris</h5>
                                <input type="hidden" name="ujian_id" value="{{ $ujianSiswa->ujian_id }}">
                                <input type="hidden" name="ujian_siswa_id" value="{{ $ujianSiswa->id }}">
                                <input type="hidden" name="mapel" value="bing">
                                <input type="hidden" name="waktu" value="90">
                                <input type="hidden" name="jumlah_soal" value="50">
                                {{-- <button class="btn btn-secondary col-12 mt-4" disabled>Test Belum Tersedia</button> --}}
                                @if ($ujianSiswa->bahasa == 0)
                                    <button type="submit" class="btn btn-primary col-12 mt-4"
                                        onclick="return confirm('Mulai Test Bahasa Inggris ?')">Mulai Ujian</button>
                                @elseIf($ujianSiswa->bahasa == 1)
                                    <button class="btn btn-secondary col-12 mt-4" disabled>NILAI UJIAN BAHASA
                                        INGGRIS
                                        <h1>{{ optional($ujianSiswa->getNilai)->bing }}</h1>
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            @if ($ujian->posisi == 'akpol')
                <div class="col-md-3">
                    <div class="card">
                        {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
                        <div class="card-body ">
                            <form method="POST" action="{{ action('AkademikUjianSiswaController@halamanUjian') }}">
                                @csrf
                                <h5 class=" text-center">Bahasa Indonesia</h5>
                                <input type="hidden" name="ujian_id" value="{{ $ujianSiswa->ujian_id }}">
                                <input type="hidden" name="ujian_siswa_id" value="{{ $ujianSiswa->id }}">
                                <input type="hidden" name="mapel" value="bind">
                                <input type="hidden" name="waktu" value="90">
                                <input type="hidden" name="jumlah_soal" value="50">
                                {{-- <button class="btn btn-secondary col-12 mt-4" disabled>Test Belum Tersedia</button> --}}
                                @if ($ujianSiswa->bahasa == 0)
                                    <button type="submit" class="btn btn-primary col-12 mt-4"
                                        onclick="return confirm('Mulai Test Bahasa Indonesia ?')">Mulai
                                        Ujian</button>
                                @elseIf($ujianSiswa->bahasa == 1)
                                    <button class="btn btn-secondary col-12 mt-4" disabled>NILAI UJIAN BAHASA
                                        INDONESIA
                                        <h1>{{ optional($ujianSiswa->getNilai)->bind }}</h1>
                                    </button>
                                @endif
                            </form>
                        </div>
                    </div>
                </div>
            @endif
            @if ($ujianSiswa->status == 1)
                <div class="col-md-4 text-center">
                    <div class="card">
                        <div class="card-header">Nilai Keseluruhan CAT AKADEMIK</div>
                        <div class="card-body">
                            <h1>{{ optional($ujianSiswa->getNilai)->nilai_akhir }}</h1>
                        </div>
                        <div class="card-footer"><a href="{{ '/' }}" class="btn btn-warning">Kembali Ke
                                Beranda</a></div>
                    </div>
                </div>
            @endif
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
