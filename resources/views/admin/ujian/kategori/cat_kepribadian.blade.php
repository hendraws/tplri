<form method="POST" action="{{ action('UjianController@store') }}" enctype='multipart/form-data' b>
    @csrf
    <div class="card-body">
        <div class="form-group row">
            <label for="judul" class="col-sm-2 col-form-label">Judul</label>
            <div class="col-md-10">
                <input id="judul" type="text" class="form-control @error('judul') is-invalid @enderror" name="judul"
                    value="{{ old('judul') }}" required autocomplete="judul" autofocus placeholder="Judul">
            </div>
        </div>
        <div class="form-group row">
            <label for="judul" class="col-sm-2 col-form-label">Aktif ?</label>
            <div class="col-md-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_active" id="flexRadioDefault2" value="1">
                    <label class="form-check-label" for="flexRadioDefault2">
                        Aktif
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="is_active" id="flexRadioDefault1" checked value="0">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Tidak Aktif
                    </label>
                </div>
            </div>
        </div>

        <div class="modal-footer">
            <button class="btn btn-brand btn-square btn-primary col">Simpan</button>
        </div>
    </div>
</form>