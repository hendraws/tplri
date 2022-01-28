<form method="POST" action="{{ action('UjianMataPelajaranController@store') }}">
    <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Tambah Mata Pelajaran Baru</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        @csrf
        <div class="form-group row">
            <label for="mapel" class="col-sm-4 col-form-label">Mata Pelajaran</label>
            <div class="col-md-8">
                <select class="form-control select" name="mata_pelajaran_id" id="mapel">
                    <option readonly selected value="">Pilih Mata Pelajaran</option>
                    @foreach ($mapel as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="passing_grade" class="col-sm-4 col-form-label">Passing Grade</label>
            <div class="col-md-8">
                <input id="passing_grade" type="number"
                    class="form-control @error('passing_grade') is-invalid @enderror" name="passing_grade"
                    value="{{ old('passing_grade') }}" required autocomplete="passing_grade" autofocus
                    placeholder="Passing Grade">
            </div>
        </div>
        <div class="form-group row">
            <label for="passing_grade" class="col-sm-4 col-form-label">Generate Soal</label>
            <div class="col-md-8">
                <div class="form-check form-check-inline">
                    <input class="form-check-input check" type="radio" name="generate_soal" id="inlineRadio1" value="Y">
                    <label class="form-check-label" for="inlineRadio1">Ya</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input check" type="radio" name="generate_soal" id="inlineRadio2" value="N"
                        checked>
                    <label class="form-check-label" for="inlineRadio2">Tidak</label>
                </div>
                <input id="jumlah_soal" type="number" class="form-control @error('jumlah_soal') is-invalid @enderror"
                    name="jumlah_soal" value="{{ old('jumlah_soal') }}" autocomplete="off" autofocus
                    style="display: none;" placeholder="Masukan Jumlah Soal">
            </div>
        </div>

    </div>
    <div class="modal-footer">
        <input type="hidden" name="ujian_id" value="{{ $ujian->id }}">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button class="btn btn-brand btn-square btn-primary" id="btnSubmit">Simpan</button>
    </div>
</form>
<script>
    $('.check').click(function() {
        if ($(this).val() == 'Y') {
            $('#jumlah_soal').show();
        } else {
            $('#jumlah_soal').hide().val(0).removeClass('is-invalid');
            $('#btnSubmit').removeAttr('disabled');
        }

    });
    var count = null;
    $(document).on('change', '#mapel', function() {
        $.ajax({
            url: "{{ url()->full() }}",
            type: 'GET',
            data: {
                mapel: $(this).val(),
            },
            contentType: 'application/json; charset=utf-8',
            success: function(response) {
                $('#jumlah_soal').val(0);
                count = response;
            },
            error: function() {
                alert("error");
            }
        });
    })

    $(document).on('keyup','#jumlah_soal' ,function(){
        if(typeof(count) != "undefined" && count !== null){
            if($(this).val() > count){
                $('#jumlah_soal').removeClass('is-valid').addClass('is-invalid');
                // .after(" <div class='invalid-feedback'>Please provide a valid city.</div> ");
                $('#btnSubmit').attr('disabled','disabled');

                Swal.fire({title: 'Jumlah Soal tidak boleh lebih dari '+count, icon: 'warning', toast: true, position: 'top-end', showConfirmButton: false, timer: 10000, timerProgressBar: true,});
            }else{
                $('#jumlah_soal').removeClass('is-invalid').addClass('is-valid');
            }
        }
    })

</script>
