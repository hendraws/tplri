<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Test Kecermatan POLRI</title>

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
            <div class="col-md-10 align-self-center">
                <img class="cover mx-2" src="{{ asset('images/polri.png') }}" alt="Rumah Private Kino">
                <img class="cover mx-2" src="{{ asset('images/polda.png') }}" alt="Rumah Private Kino">
                <img class="cover mx-2" src="{{ asset('images/bg.png') }}" alt="Rumah Private Kino">
            </div>
            <div class="col-md-2 align-self-center">

                    <div id="countdowntimer2"><span id="timer"><span></div>
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
                                <div id="countdowntimer"><span id="timerSesi"><span></div>
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
                                <form action="{{ action('UjianSiswaController@simpanJawabanKecermatanSama') }}"
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
        var jumlahSeluruhSoal = "{{ $soalKecermatan->count() }}";
        var ujianSiswaId = "{{ $ujianSiswa->id }}";
        var soalKe = 0;
        var soalId, jawabanBenar;
        let soalSekarang = [];
        let hitungJawaban = 0;
        const PengaturanJumlahKolom = 10;
        const PengaturanJumlahSoal = 50;
        // const PengaturanJumlahKolom = 1;
        // const PengaturanJumlahSoal = 10;
        let semuaSoal = <?= json_encode($soalKecermatan) ?>;

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
                borderColor: "#e43205",
                backgroundColor: "#e43205",
                fontColor: "#f6e8c6",
                timeUp: timeisUp,
            });
            sesiTimer();
        });

        function sesiTimer() {
            soalKe++;
            $('#countdowntimer').addClass('none');
            $("#timerSesi").countdowntimer({
                minutes: waktuSesi,
                size: "lg",
                borderColor: "#f6e8c6",
                backgroundColor: "#f6e8c6",
                fontColor: "#e43205",
                timeUp: gantiSoal,
            });
        }

        const interval = setInterval(function() {
        if($("#timerSesi").text() == '00:06'){
            $('#countdowntimer').removeClass('none');
        }
        }, 1000);


        function resetSoal(soalKe) {
            if (soalKe == PengaturanJumlahKolom) {
                selesaiTest();
            }
            tampilSoal(soalKe);
            acakSoal(soal);
            hitungJawaban = 0;
        }

        $(document).on('change', '.pilih', function(e) {

            if ($(".pilih").is(":checked")) {
                var jawaban = $(this);

                var jb = $('#jb').val();


                if (jawaban.val() == jb) {
                    var statusJawaban = 1;
                } else {
                    var statusJawaban = 0;
                }

                simpanJawaban(ujianSiswaId, soalId, soalSekarang, jawaban.val(), statusJawaban);
            }

        })

        function simpanJawaban(ujianSiswaId, soalId, soalHilang, jawaban, jb) {
            console.log('jawaban anda = '+ jawaban, 'apakah benar => '+ jb)
            var url = $('#formUjian').attr('action');

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

                        setTimeout(function() {
                            var number = Math.floor((Math.random()*5) + 0); //random number 0-4
                            jawabanSamaBenar = jawabanSama[number];
                            soal = jawabanSamaBenar.split('');

                            console.log('soal => ' + jawabanSamaBenar, 'soal-pecah => ' +soal);
                            acakSoal(soal);
                            $('input:radio').prop('checked', false);
                        }, 100);
                        console.log('no:' + hitungJawaban + ' -max- ' + PengaturanJumlahSoal);
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

        function tampilSoal(index) {
            console.log('function tampil soal no ', index);
            console.table(semuaSoal[index]);
            $('#soalKecerdasan').html(`

            <tr class="text-center" style="font-size:20px">
                <td style="width: 20%;" class="border-0">A.</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_a"].split('')[0]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_a"].split('')[1]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_a"].split('')[2]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_a"].split('')[3]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_a"].split('')[4]).text() + `</td>
            </tr>
            <tr class="text-center" style="font-size:20px">
                <td style="width: 20%;" class="border-0">B.</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_b"].split('')[0]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_b"].split('')[1]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_b"].split('')[2]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_b"].split('')[3]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_b"].split('')[4]).text() + `</td>
            </tr>
            <tr class="text-center" style="font-size:20px">
                <td style="width: 20%;" class="border-0">C.</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_c"].split('')[0]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_c"].split('')[1]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_c"].split('')[2]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_c"].split('')[3]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_c"].split('')[4]).text() + `</td>
            </tr>
            <tr class="text-center" style="font-size:20px">
                <td style="width: 20%;" class="border-0">D.</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_d"].split('')[0]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_d"].split('')[1]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_d"].split('')[2]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_d"].split('')[3]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_d"].split('')[4]).text() + `</td>
            </tr>
            <tr class="text-center" style="font-size:20px">
                <td style="width: 20%;" class="border-0">E.</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_e"].split('')[0]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_e"].split('')[1]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_e"].split('')[2]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_e"].split('')[3]).text() + `</td>
                <td style="width: 15%;">` + $("<div/>").html(semuaSoal[index]["jawaban_e"].split('')[4]).text() + `</td>
            </tr>
            `);



            soal = jawabanSama = [];
            jawabanSama[0] = semuaSoal[index]["jawaban_a"];
            jawabanSama[1] = semuaSoal[index]["jawaban_b"];
            jawabanSama[2] = semuaSoal[index]["jawaban_c"];
            jawabanSama[3] = semuaSoal[index]["jawaban_d"];
            jawabanSama[4] = semuaSoal[index]["jawaban_e"];
            soalId = semuaSoal[index]['id'];

            var number = Math.floor((Math.random()*5) + 0); //random number 0-4

            jawabanSamaBenar = jawabanSama[number];
            soal = jawabanSamaBenar.split('');

            console.log('soal => ' + jawabanSamaBenar, 'soal-pecah => ' +soal);

            // tampil radio button abcde
            $('#PilihanJawaban').html(`
            <tr class="">
                <td style="width: 20%;" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-a" value="` +
                jawabanSama[0] + `">
                        <label class="form-check-label" for="pilihan-a">
                            a
                        </label>
                    </div>
                </td>
                <td style="width: 20%;" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-b" value="` +
                jawabanSama[1] + `">
                        <label class="form-check-label" for="pilihan-b">
                            b
                        </label>
                    </div>
                </td>
                <td style="width: 20%;" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-c" value="` +
                jawabanSama[2] + `">
                        <label class="form-check-label" for="pilihan-c">
                            c
                        </label>
                    </div>
                </td>
                <td style="width: 20%;" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-d" value="` +
                jawabanSama[3] + `">
                        <label class="form-check-label" for="pilihan-d">
                            d
                        </label>
                    </div>
                </td>
                <td style="width: 20%;" class="soal">
                    <div class="form-check">
                        <input class="form-check-input pilih" type="radio" name="pilihan[]" id="pilihan-e" value="` +
                jawabanSama[4] + `">
                        <label class="form-check-label" for="pilihan-e">
                            e
                        </label>
                    </div>
                </td>
                <input type="hidden" name="soalId" id="soal-id" value="` + soalId + `">
                </tr>
            `)

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
                <td style="width: 20%">` + $("<div/>").html(arr[4]).text() + `</td>
                <input type="hidden" name="jb" id="jb" value="` + jawabanSamaBenar + `">
            </tr>
            `);



            soalSekarang = [];
            soalSekarang[0] = arr[0];
            soalSekarang[1] = arr[1];
            soalSekarang[2] = arr[2];
            soalSekarang[3] = arr[3];
            soalSekarang[4] = arr[4];
            jawabanBenar = jawabanSamaBenar;

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
