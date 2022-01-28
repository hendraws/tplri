<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Ujian</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-4/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/countdowntimer/jquery.countdownTimer.css') }}">
    <style>
        .bagianTitle {
            min-height: 15vh;
        }

        .bagianBody {
            min-height: 85vh;
        }

        p img {
            width: 400px !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid" style="min-height:100vh;">
        <div class="row">
            <div class="col-md-12 border bagianTitle">
                <div class="row py-2" style="height:100%">
                    <div class="col-md-3 align-self-center">
                        <div class="row align-self-center">
                            <div class="col-12">
                                <img src="{{ asset('images/kino.png') }}" alt="Rumah Private Kino" width="40%">
                            </div>
                            <div class="col-6 ">
                                Nama
                            </div>
                            <div class="col-6 ">
                                : {{ ucfirst($ujianSiswa->getSiswa->name) }}
                            </div>
                            <div class="col-6 ">
                                Program Akademik
                            </div>
                            <div class="col-6 ">
                                :
                                {{ ucfirst(optional(optional($ujianSiswa->getSiswa)->getProgramAkademik)->nama_program) }}
                            </div>
                            <div class="col-6 ">
                                Ujian
                            </div>
                            <div class="col-6 ">
                                :
                                {{ ucfirst(optional(optional($ujianSiswa->getSiswa)->getProgramAkademik)->nama_program) }}
                            </div>

                        </div>
                    </div>
                    <div class="col-md-9 align-self-center">
                        <div class="row">
                            <div class="col-md-9 align-self-center px-5">
                                <div class="progress ">
                                    <div id="progress-bar" class="progress-bar progress-bar-striped " role="progressbar"
                                        aria-valuenow="1" aria-valuemin="0" aria-valuemax="4" style="width: 5%">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 align-self-center text-center">
                                <div id="countdowntimer"><span id="timer"><span></div>
                                <a href="javascript:void(0)" class="btn btn-danger col-12">Selesai Ujian</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-3 border bagianBody">
                <div class="row p-2">
                    @for ($i = 1; $i <= count($ujian->getSoal); $i++)
                        <div class="col-md-3 col-3">
                            <a href="javascript:void(0)" class="badge badge-secondary w-100 p-1 nomor-urutan"
                                data-no="{{ $i }}">No.
                                {{ $i }}</a>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="col-md-9 border bagianBody">
                <form action="{{ action('UjianSiswaController@simpanData') }}" id="formUjian">
                    <div class="row">
                        <div class="col-12">
                            @include('ujian.list_soal')
                        </div>
                    </div>
                    <input type="hidden" name="ujian_id" value="{{ $ujian->id }}" >
                    <input type="hidden" name="ujian_siswa_id" value="{{ $ujianSiswa->id }}" >
                </form>
            </div>
        </div>

    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-4/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-4/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/countdowntimer/jquery.countdownTimer.min.js') }}"></script>
    <script>
        let waktuBerjalan = "{{ $ujianSiswa->waktu_berjalan }}";
        var jumlahSeluruhSoal = "{{ $ujian->getSoal->count() }}";

    </script>
    <script src="{{ asset('js/ujian.js') }}"></script>


</body>

</html>
