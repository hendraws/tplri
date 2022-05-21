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
            <label for="kategori" class="col-sm-2 col-form-label">Kategori CAT</label>
            <div class="col-md-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kategori" id="flexRadioDefault2" checked value="all">
                    <label class="form-check-label" for="flexRadioDefault2">
                        CAT AKADEMIK KESELURUHAN
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kategori"  value="bind">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Bahasa Indonesia
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kategori"  value="bing">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Bahasa Inggris
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kategori"  value="mtk">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Matematika
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kategori"  value="pu">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Pengetahuan Umum
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="kategori"  value="wk">
                    <label class="form-check-label" for="flexRadioDefault1">
                        Wawasan Kebangsaan
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label for="judul" class="col-sm-2 col-form-label">Posisi Jabatan</label>
            <div class="col-md-10">
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="posisi" id="flexRadioDefault2" value="akpol">
                    <label class="form-check-label" for="flexRadioDefault2">
                        AKPOL
                    </label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="posisi"  checked value="bintara">
                    <label class="form-check-label" for="flexRadioDefault1">
                        BINTARA
                    </label>
                </div>
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
                    <input class="form-check-input" type="radio" name="is_active"  checked value="0">
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
