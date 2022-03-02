<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Test Kepribadian POLRI</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-4/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/countdowntimer/jquery.countdownTimer.css') }}">
    <style>
        body {
            background: #f6e8c6;
        }

        .bagianTitle {
            min-height: 15vh;
        }

        .bagianBody {
            min-height: 85vh;
        }

        p img {
            width: 400px !important;
        }

        .cover {
            object-fit: cover;
            height: 100px;
        }

        input[type="radio"] {
            -ms-transform: scale(1.5); /* IE 9 */
            -webkit-transform: scale(1.5); /* Chrome, Safari, Opera */
            transform: scale(1.5);
        }
    </style>
</head>

<body>
    <div class="container-fluid" style="min-height:100vh;">
        <div class="row p-3" style="background: #e43205;">
            <div class="col-9 align-self-center">
                <img class="cover mx-2" src="{{ asset('images/polri.png') }}" alt="Rumah Private Kino">
                <img class="cover mx-2" src="{{ asset('images/polda.png') }}" alt="Rumah Private Kino">
                <img class="cover mx-2" src="{{ asset('images/bg.png') }}" alt="Rumah Private Kino">
            </div>
            <div class="col-2 align-self-center text-center">
                <div id="countdowntimer"><span id="timer"><span></div>
                <button type="button" id="selesiTest" class="btn btn-warning">Selesai
                    Test</button>
                <form action="{{ action('UjianSiswaController@simpanJawabanKecerdasan') }}" id="selesaiUjianForm"
                    method="POST">
                    @csrf
                    <input type="hidden" name="ujianSiswaId" value="{{ $ujianSiswa->id }}">
                    <input type="hidden" name="status" value="selesai_test">
                </form>
            </div>
        </div>
        <div class="row">
            {{-- <div class="col-md-12 border bagianTitle">
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
                                Test
                            </div>
                            <div class="col-6 ">
                                :
                                Kecerdasan POLRI
                            </div>

                        </div>
                    </div>
                    <div class="col-md-9 align-self-center">
                        <div class="row">
                            <div class="col-md-9 align-self-center px-5">
                                <div class="progress ">
                                    <div id="progress-bar" class="progress-bar progress-bar-striped " role="progressbar"
                                        aria-valuenow="1" aria-valuemin="0" aria-valuemax="4">
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-3 align-self-center text-center">
                                <div id="countdowntimer"><span id="timer"><span></div>
                                <button type="button" id="selesiTest" class="btn btn-danger col-12">Selesai
                                    Test</button>
                                <form action="{{ action('UjianSiswaController@simpanJawabanKecerdasan') }}"
                                    id="selesaiUjianForm" method="POST">
                                    @csrf
                                    <input type="hidden" name="ujianSiswaId" value="{{ $ujianSiswa->id }}">
                                    <input type="hidden" name="status" value="selesai_test">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="col-md-3 border bagianBody">
                <div class="row p-2">
                    @for ($i = 1; $i <= 100; $i++)
                        <div class="col-md-3 col-3">
                            <a href="javascript:void(0)" class="badge badge-danger w-100 p-1 nomor-urutan"
                                data-no="{{ $i }}">
                                {{ $i }}</a>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="col-md-9 border bagianBody">
                <div class="row">
                    <div class="col-12">
                        @include('ujian.kepribadian_soal')
                    </div>
                </div>
                <form action="{{ action('UjianSiswaController@simpanJawabanKepribadian') }}" id="formUjian" method="POST">
                    @csrf
                    <input type="hidden" name="ujian_id" value="{{ $ujian->id }}">
                    <input type="hidden" name="ujian_siswa_id" value="{{ $ujianSiswa->id }}">
                    <input type="hidden" name="status" value="selesai_test">
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
        let waktuBerjalan = 90;
        var jumlahSeluruhSoal = "{{ $ujian->getSoalKecerdasan->count() }}";
        var ujianSiswaId = "{{ $ujianSiswa->id }}";

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        function simpanJawaban(ujianSiswaId, noSoal, jawaban, skor, sesi, urutan) {

            var url = $('#formUjian').attr('action');
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "ujianSiswaId": ujianSiswaId,
                    "noSoal": noSoal,
                    "jawaban": jawaban,
                    "skor": skor,
                    "sesi": sesi,
                },
                success: function(data) {
                    if (data.code == '200') {
                        if($("input[type='radio'][name='pilihan[" + noSoal + "]']:checked").length > 0){
                            $("a[data-no=" + urutan + "]").removeClass().addClass('badge badge-success w-100 p-1 nomor-urutan');
                        }
                        console.log('berhasil');
                    } else {
                        // alert('Jawaban Tidak boleh kosong');
                        console.log('gagal');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        function selesaiTest(ujianSiswaId) {

            var url = "{{ action('UjianSiswaController@simpanJawabanKecerdasan') }}";
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "ujianSiswaId": ujianSiswaId,
                    "status": 'selesai_test',
                },
                success: function(data) {
                    if (data.code == '200') {
                        console.log('berhasil');
                    } else {
                        console.log('gagal');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }

        $(document).on('click', '#selesiTest', function() {
            if (confirm("Apakah Anda Yakin Menyelesaikan Test ?") == true) {
                $('form#formUjian').submit();
            } else {
                text = "You canceled!";
            }
        })
    </script>
    <script src="{{ asset('js/ujian_kepribadian.js') }}"></script>
</body>

</html>
