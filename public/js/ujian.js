var semuaJawaban = JSON.parse(localStorage.getItem("semuaJawaban")) ?? [];
let urutanTerkahir = 1;
let urutanSekarang = 1;
var storedNames = JSON.parse(localStorage.getItem("semuaJawaban"));

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// reload jawaban ketika ada di lokalstorate (referesh)
$.each(storedNames, function (urutanSoal, jawaban) {
    if (jawaban !== null) {
      $('#pilihan-' + jawaban.jawaban).prop("checked", true);
        if (jawaban.jawaban != null) {
            $("a[data-no=" + urutanSoal + "]").removeClass('badge-secondary').addClass('badge-primary');
        }
    }
    setProgressBar();
})

// event ketika klik nomor disamping
$(document).on('click', '.nomor-urutan', function () {

    let nomorUrut = $(this).data('no');

    $('#list-' + urutanTerkahir).hide();
    $('#list-' + nomorUrut).show();

    urutanTerkahir = nomorUrut;
    urutanSekarang = nomorUrut;

});


// klik tombol simpan & lanjutkan ke lokalstorage
$('.simpan').click(function () {

    var noSoal = $(this).data('soal');
    var urutan = $(this).data('urutan');
    var jawaban = $("input[type='radio'][name='pilihan[" + noSoal + "]']:checked").val();
    let urutanSelanjutnya = urutan + 1;
    urutanTerkahir = urutanSelanjutnya;
    semuaJawaban[urutan] = {
        'soal': noSoal,
        'jawaban': jawaban
    };

    localStorage.setItem("semuaJawaban", JSON.stringify(semuaJawaban));
    var storedNames = JSON.parse(localStorage.getItem("semuaJawaban"));

    var jumlahJawab = $('input:radio:checked').length;
    if (jumlahJawab % 2 == 0) {
        submitData();
    }

    $('#list-' + urutan).hide();

    if ($('#list-' + urutanSelanjutnya).length) {
        $('#list-' + urutanSelanjutnya).show();
    } else {
        urutanTerkahir = 1;
        $('#list-' + 1).show();
    }
    if($("input[type='radio'][name='pilihan[" + noSoal + "]']:checked").length > 0){
        $("a[data-no=" + urutan + "]").removeClass().addClass('badge badge-primary w-100 p-1 nomor-urutan');
    }else{
        $("a[data-no=" + urutan + "]").removeClass().addClass('badge badge-secondary w-100 p-1 nomor-urutan');
    }
    setProgressBar();
    // console.log(storedNames, noSoal, jawaban, localStorage.getItem("semuaJawaban"), );

});

// klik tombol ragu
$('.ragu').click(function () {

    var noSoal = $(this).data('soal');
    var urutan = $(this).data('urutan');
    var jawaban = $("input[type='radio'][name='pilihan[" + noSoal + "]']:checked").val();
    let urutanSelanjutnya = urutan + 1;
    urutanTerkahir = urutan;
    semuaJawaban[urutan] = {
        'soal': noSoal,
        'jawaban': jawaban
    };
    displayNone();
    localStorage.setItem("semuaJawaban", JSON.stringify(semuaJawaban));

    var jumlahJawab = $('input:radio:checked').length;
    if (jumlahJawab % 2 == 0) {
        submitData();
    }


    $('#list-' + urutan).hide();

    if ($('#list-' + urutanSelanjutnya).length) {
        $('#list-' + urutanSelanjutnya).show();
    } else {
        $('#list-' + 1).show();
        urutanTerkahir = 1;
    }

    $("a[data-no=" + urutan + "]").removeClass().addClass('badge badge-warning w-100 p-1 nomor-urutan');
    // console.log(storedNames, noSoal, jawaban, localStorage.getItem("semuaJawaban"), );
    setProgressBar();

});

// tombol kosongkan pilihan
$('.kosongkan').click(function () {

    var noSoal = $(this).data('soal');
    var urutan = $(this).data('urutan');
    var jawaban = $("input[type='radio'][name='pilihan[" + noSoal + "]']:checked");
    jawaban.prop('checked', false);
    let urutanSelanjutnya = urutan + 1;
    urutanTerkahir = urutan;
    semuaJawaban[urutan] = {
        'soal': noSoal,
        'jawaban': null
    };

    localStorage.setItem("semuaJawaban", JSON.stringify(semuaJawaban));
    var storedNames = JSON.parse(localStorage.getItem("semuaJawaban"));

    var jumlahJawaban = storedNames.length - 1;
    if (jumlahJawaban % 10 == 0) {
        alert(jumlahJawaban);
    }

    $('#list-' + urutan).hide();

    if ($('#list-' + urutanSelanjutnya).length) {
        $('#list-' + urutanSelanjutnya).show();
    } else {
        $('#list-' + 1).show();
        urutanTerkahir = 1;
    }

    $("a[data-no=" + urutan + "]").removeClass().addClass('badge badge-secondary w-100 p-1 nomor-urutan');
    // console.log(storedNames, noSoal, jawaban, localStorage.getItem("semuaJawaban"), );
    setProgressBar();

});


// fungsi timercount down
$(function () {
    $("#timer").countdowntimer({
        minutes: waktuBerjalan,
        size: "lg",
        borderColor: "#ffffff",
        backgroundColor: "#ffffff",
        fontColor: "#FA0909",
        timeUp: timeisUp,
    });
});

// action waktu habis
function timeisUp() {
    alert('asdf');
}

// simpan data
function submitData() {
    var form = $('#formUjian');
    var url = form.attr('action');
    let timeprogress = $('#timer').text().split(":");

    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize()  + "&sisa_waktu=" + timeprogress[0], // serializes the form's elements.
        success: function (data) {
            console.log(data);
        }
    });
}

function displayNone(){
    $('.list-soal').removeAttr("style").css("display", "none");
}

function setProgressBar() {

    let jumlahJawaban = $('input[type="radio"]:checked').length;
    let jumlahJawabanPersentase = jumlahJawaban / jumlahSeluruhSoal * 100;
    if(jumlahJawabanPersentase == 0 ){
        $('#progress-bar').removeAttr("style").css("width", jumlahJawabanPersentase+"%").html(jumlahJawaban + " Soal");
    }

}

function setTimeProgress(){
    let timeprogress = $('#timer').text().split(":");
    localStorage.setItem("getTimeUjian", timeprogress[0]);
}
