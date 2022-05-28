var semuaJawaban = JSON.parse(localStorage.getItem("semuaJawaban")) ?? [];
let urutanTerkahir = 1;
let urutanSekarang = 1;
var storedNames = JSON.parse(localStorage.getItem("semuaJawaban"));


// reload jawaban ketika ada di lokalstorate (referesh)
// $.each(storedNames, function (urutanSoal, jawaban) {
//     if (jawaban !== null) {
//       $('#pilihan-' + jawaban.jawaban).prop("checked", true);
//         if (jawaban.jawaban != null) {
//             $("a[data-no=" + urutanSoal + "]").removeClass('badge-secondary').addClass('badge-primary');
//         }
//     }
//     setProgressBar();
// })

// event ketika klik nomor disamping
$(document).on('click', '.nomor-urutan', function () {

    let nomorUrut = $(this).data('no');
    $('.list-soal').hide();
    $('#list-' + nomorUrut).show();

    urutanTerkahir = nomorUrut;
    urutanSekarang = nomorUrut;

});


// klik tombol simpan & lanjutkan ke lokalstorage
$('.simpan').click(function () {
    $(this).addClass('disabled');

    var noSoal = $(this).data('soal');
    var urutan = $(this).data('urutan');
    var jb = $(this).data('jb');
    var jawaban = $("input[type='radio'][name='pilihan[" + noSoal + "]']:checked").val();
    let urutanSelanjutnya = urutan + 1;
    urutanTerkahir = urutanSelanjutnya;
    semuaJawaban[urutan] = {
        'soal': noSoal,
        'jawaban': jawaban
    };
    var waktu = $('#timer').html().split(":")[0];

    console.log(jb, $(this));
    simpanJawaban(ujianSiswaId, noSoal,jawaban,jb,urutan, waktu);

    if($("input[type='radio'][name='pilihan[" + noSoal + "]']:checked").length > 0){
        $("a[data-no=" + urutan + "]").removeClass().addClass('badge badge-success w-100 p-1 nomor-urutan');
    }
});
// klik tombol simpan & lanjutkan ke lokalstorage
$('.lanjutkan').click(function () {
    var urutan = $(this).data('urutan');
    let urutanSelanjutnya = urutan + 1;
    urutanTerkahir = urutanSelanjutnya;
    $('#list-' + urutan).hide();
    if ($('#list-' + urutanSelanjutnya).length) {
        $('#list-' + urutanSelanjutnya).show();
    } else {
        urutanTerkahir = 1;
        $('#list-' + 1).show();
    }
});

// fungsi timercount down
$(function () {
    $("#timer").countdowntimer({
        minutes: waktuBerjalan,
        size: "lg",
        borderColor: "#e43205",
        backgroundColor: "#e43205",
        fontColor: "#f6e8c6",
        timeUp: timeisUp,
    });
});

// action waktu habis
function timeisUp() {
    $("input[type=radio]").attr('disabled', true);
    alert('waktu Habis');
    $('form#selesaiUjianForm').submit();
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

