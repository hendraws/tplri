<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Test Kecerdasan POLRI</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-4/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/countdowntimer/jquery.countdownTimer.css') }}">
    <style>
        body {
            background: #f6e8c6;
        }

        tr .bagianTitle {
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

        table#soalKecerdasan tr td {
            border: solid;
        }

        table#soalAcak tr td {
            border: solid;
        }


        .soal{
            padding:0;
        }
        .none {
            display: none;
        }

        @media (max-width:641px) {
            .cover {
                object-fit: cover;
                height: 50px;
            }
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
            <div class="col-12 align-self-center">
                <img class="cover mx-2" src="{{ asset('images/polri.png') }}" alt="Rumah Private Kino">
                <img class="cover mx-2" src="{{ asset('images/polda.png') }}" alt="Rumah Private Kino">
                <img class="cover mx-2" src="{{ asset('images/bg.png') }}" alt="Rumah Private Kino">
            </div>
        </div>
        <div class="row">

            <div class="col-md-12 bagianTitle">
                <div class="row py-2" style="height:100%">
                    <div class="col-md-3 align-self-center">

                    </div>
                    <div class="col-md-9 align-self-center">
                        <div class="row">
                            <div class="col-md-9 align-self-center px-5">
                                <table class="table  px-5 table-borderless">
                                    <thead class="thead">
                                        <tr class="text-left">
                                            <th colspan="5">Petunjuk Soal</th>
                                        </tr>
                                        <table class="table  table-bordered border-dark px-5" id="soalKecerdasan">
                                        </table>
                                    </thead>
                                </table>


                            </div>
                            <div class="col-md-3 align-self-center text-center">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 bagianTitle mt-5">
                <div class="row py-2" style="height:100%">
                    <div class="col-md-3 align-self-center">
                    </div>
                    <div class="col-md-9 align-self-center">
                        <div class="row">
                            <div class="col-md-9 align-self-center px-5">
                                <table class="table  table-borderless px-5">
                                    <thead class="thead">
                                        <tr class="text-left">
                                            <th colspan="5">Soal</th>
                                        </tr>
                                    </thead>
                                </table>
                                <table class="table  table-bordered px-5" id="soalAcak">
                                </table>
                                <table class="table  table-borderless px-5">
                                    <thead class="thead">
                                        <tr class="text-left">
                                        </tr>
                                        <th colspan="5">Jawaban Anda</th>
                                    </thead>
                                </table>
                                <table class="table  table-borderless px-5" id="PilihanJawaban">
                                </table>

                            </div>
                            <div class="col-md-3 align-self-center text-center">
                                <div id="countdowntimer" class="none"><span id="timerSesi"><span></div>
                                <div id="countdowntimer2" class="none"><span id="timer"><span></div>
                                <form action="{{ action('UjianSiswaController@simpanJawabanKecermatan') }}"
                                    id="formUjian" method="POST">
                                    @csrf
                                    <input type="hidden" name="ujianSiswaId" id="ujianSiswaId"
                                        value="{{ $ujianSiswa->id }}">
                                    <input type="hidden" name="status" value="selesai_test">
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="stayed"></div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-4/popper.min.js') }}"></script>
    <script src="{{ asset('vendors/bootstrap-4/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('vendors/countdowntimer/jquery.countdownTimer.min.js') }}"></script>
    <script>
        let waktuSesi = 1;
        let waktuBerjalan = 10;
        var jumlahSeluruhSoal = "{{ $ujian->getSoalKecerdasan->count() }}";
        var ujianSiswaId = "{{ $ujianSiswa->id }}";
        var soalKe = 0;
        var soalId, jawabanBenar;
        let soalSekarang = [];
        let hitungJawaban = 0;
        const PengaturanJumlahKolom = 10;
        const PengaturanJumlahSoal = 50;
        let semuaSoal = <?= json_encode($ujian->getSoalKecermatan) ?>;

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        //
        // jquery ready function
        $(function() {

            resetSoal(soalKe);

            $("#timer").countdowntimer({
                minutes: waktuBerjalan,
                size: "lg",
                borderColor: "#ffffff",
                backgroundColor: "#ffffff",
                fontColor: "#ffffff",
                timeUp: timeisUp,
            });
            sesiTimer();

            // window.addEventListener('beforeunload', function(e) {
            //     // Cancel the event
            //     e.preventDefault(); // If you prevent default behavior in Mozilla Firefox prompt will always be shown
            //     // Chrome requires returnValue to be set
            //     e.returnValue = '';
            // });
        });

        function sesiTimer() {
            soalKe++;
            $("#timerSesi").countdowntimer({
                minutes: waktuSesi,
                size: "lg",
                borderColor: "#ffffff",
                backgroundColor: "#ffffff",
                fontColor: "#ffffff",
                timeUp: gantiSoal,
            });
        }

        function resetSoal(soalKe) {
            if (soalKe == PengaturanJumlahKolom) {
                selesaiTest();
            }
            tampilSimbol(soalKe);
            console.log("reset:" + soal);
            acakSoal(soal);
        }

        $(document).on('change', '.pilih', function(e) {
            // e.preventDefault();

            // var jawaban = $(this).find('input:radio').prop('checked', true);
            if ($(".pilih").is(":checked")) {
                var jawaban = $(this);

                var jb = $('#jb').val();
                if (jawaban.val() == jb) {
                    var statusJawaban = 1;
                } else {
                    var statusJawaban = 0;
                }
                console.log('stat' + statusJawaban);

                console.log('jawab : ' + statusJawaban + ' , hitungJawaban : ' + hitungJawaban);

                simpanJawaban(ujianSiswaId, soalId, soalSekarang, jawaban.val(), statusJawaban);
                // setTimeout(function() {}, 300);
            }

        })

        function simpanJawaban(ujianSiswaId, soalId, soalHilang, jawaban, jb) {
            console.log('SIMPNJA ' + ujianSiswaId, soalHilang, jawaban, jb);
            var url = $('#formUjian').attr('action');
            console.log(url);
            $.ajax({
                type: 'POST',
                url: url,
                data: {
                    "_token": "{{ csrf_token() }}",
                    "ujianSiswaId": ujianSiswaId,
                    "soal_id": soalId,
                    "soal": soalHilang,
                    "jawaban": jawaban,
                    "jb": jb,
                },
                success: function(data) {
                    if (data.code == '200') {
                        console.log(data);
                        setTimeout(function() {
                            acakSoal(soal);
                            $('input:radio').prop('checked', false);
                        }, 300);
                        console.log('ht:' + hitungJawaban + ' -asd- ' + PengaturanJumlahSoal);
                        hitungJawaban++;
                        if (hitungJawaban == PengaturanJumlahSoal) {
                            resetSoal(soalKe);
                            soalKe++;
                            hitungJawaban = 0;
                        }
                    } else {
                        console.log('gagal');
                    }
                },
                error: function(data) {
                    console.log(data);
                }
            });
        }


        // action waktu habis
        function timeisUp() {
            selesaiTest();

        }

        function gantiSoal() {
            resetSoal(soalKe);
            sesiTimer();
        }


        function shuffle(array) {
            let currentIndex = array.length,
                randomIndex;

            // While there remain elements to shuffle...
            while (currentIndex != 0) {

                // Pick a remaining element...
                randomIndex = Math.floor(Math.random() * currentIndex);
                currentIndex--;

                // And swap it with the current element.
                [array[currentIndex], array[randomIndex]] = [
                    array[randomIndex], array[currentIndex]
                ];
            }

            return array;
        }

        function tampilSimbol(index) {


            $('#soalKecerdasan').html(`
            <tr class="text-center">
                <td style="width: 20%">a</td>
                <td style="width: 20%">b</td>
                <td style="width: 20%">c</td>
                <td style="width: 20%">d</td>
                <td style="width: 20%">e</td>
            </tr>
            <tr class="text-center" style="font-size:20px">
                <td style="width: 20%;">` + $("<div/>").html(semuaSoal[index]["soal_a"]).text() + `</td>
                <td style="width: 20%;">` + $("<div/>").html(semuaSoal[index]["soal_b"]).text() + `</td>
                <td style="width: 20%;">` + $("<div/>").html(semuaSoal[index]["soal_c"]).text() + `</td>
                <td style="width: 20%;">` + $("<div/>").html(semuaSoal[index]["soal_d"]).text() + `</td>
                <td style="width: 20%;">` + $("<div/>").html(semuaSoal[index]["soal_e"]).text() + `</td>
            </tr>
            `);

            soal = [];
            soal[0] = semuaSoal[index]["soal_a"];
            soal[1] = semuaSoal[index]["soal_b"];
            soal[2] = semuaSoal[index]["soal_c"];
            soal[3] = semuaSoal[index]["soal_d"];
            soal[4] = semuaSoal[index]["soal_e"];
            soalId = semuaSoal[index]['id'];

            baseSoal = [];
            baseSoal[0] = semuaSoal[index]["soal_a"];
            baseSoal[1] = semuaSoal[index]["soal_b"];
            baseSoal[2] = semuaSoal[index]["soal_c"];
            baseSoal[3] = semuaSoal[index]["soal_d"];
            baseSoal[4] = semuaSoal[index]["soal_e"];
            baseSoal[5] = semuaSoal[index]["id"];

            $('#PilihanJawaban').html(`
            <tr class="">
                <td style="width: 20%;" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-a" value="` +
                soal[0] + `">
                        <label class="form-check-label" for="pilihan-a">
                            a
                        </label>
                    </div>
                </td>
                <td style="width: 20%;" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-b" value="` +
                soal[1] + `">
                        <label class="form-check-label" for="pilihan-b">
                            b
                        </label>
                    </div>
                </td>
                <td style="width: 20%;" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-c" value="` +
                soal[2] + `">
                        <label class="form-check-label" for="pilihan-c">
                            c
                        </label>
                    </div>
                </td>
                <td style="width: 20%;" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-d" value="` +
                soal[3] + `">
                        <label class="form-check-label" for="pilihan-d">
                            d
                        </label>
                    </div>
                </td>
                <td style="width: 20%;" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-e" value="` +
                soal[4] + `">
                        <label class="form-check-label" for="pilihan-e">
                            e
                        </label>
                    </div>
                </td>
                <input type="hidden" name="soalId" id="soal-id" value="` + soalId + `">
                </tr>
            `)

            console.log('tampil simbol : ' + soal, soalId);

        }

        // untuk acak soal
        function acakSoal(arr) {
            arr = shuffle(arr);
            $('#soalAcak').html(`
            <tr class="text-center" style="font-size:20px">
                <td style="width: 20%">` + $("<div/>").html(arr[0]).text() + `</td>
                <td style="width: 20%">` + $("<div/>").html(arr[1]).text() + `</td>
                <td style="width: 20%">` + $("<div/>").html(arr[2]).text() + `</td>
                <td style="width: 20%">` + $("<div/>").html(arr[3]).text() + `</td>
                <td style="width: 20%"></td>
                <input type="hidden" name="jb" id="jb" value="` + arr[4] + `">
            </tr>
            `);

            soalSekarang = [];
            soalSekarang[0] = arr[0];
            soalSekarang[1] = arr[1];
            soalSekarang[2] = arr[2];
            soalSekarang[3] = arr[3];
            jawabanBenar = arr[4];

            console.log('tampil jawaban Benar : ' + soalSekarang, jawabanBenar);
        }

        function acakPilihan(arr) {

            $('#pilihanAcak').html(`
            <tr class="">
                <td style="width: 20%" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-a" value="` +
                arr[0] + `">
                        <label class="form-check-label" for="pilihan-a">
                            a. ` + $("<div/>").html(arr[0]).text() + `
                        </label>
                    </div>
                </td>
                <td style="width: 20%" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-b" value="` +
                arr[1] + `">
                        <label class="form-check-label" for="pilihan-b">
                            b. ` + $("<div/>").html(arr[1]).text() + `
                        </label>
                    </div>
                </td>
                <td style="width: 20%" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-c" value="` +
                arr[2] + `">
                        <label class="form-check-label" for="pilihan-c">
                            c. ` + $("<div/>").html(arr[2]).text() + `
                        </label>
                    </div>
                </td>
                <td style="width: 20%" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-d" value="` +
                arr[3] + `">
                        <label class="form-check-label" for="pilihan-d">
                            d. ` + $("<div/>").html(arr[3]).text() + `
                        </label>
                    </div>
                </td>
                <td style="width: 20%" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-e" value="` +
                arr[4] + `">
                        <label class="form-check-label" for="pilihan-e">
                            e. ` + $("<div/>").html(arr[4]).text() + `
                        </label>
                    </div>
                </td>
                <input type="hidden" name="soalId" id="soal-id" value="` + soalId + `">
                <input type="hidden" name="jb" id="jb" value="` + jawabanBenar + `">
                </tr>
            `)
        }



        function selesaiTest() {
            $("input[type=radio]").attr('disabled', true);
            alert('Anda Telah Menyelesaikan Ujian');
            $('form#formUjian').submit();
        }

        $(document).on('click', '#selesiTest', function() {
            if (confirm("Apakah Anda Yakin Menyelesaikan Test ?") == true) {
                $('form#selesaiUjianForm').submit();
            } else {
                text = "You canceled!";
            }
        })
    </script>
    <script src="{{ asset('js/ujian_kecermatan.js') }}"></script>


</body>

</html>
