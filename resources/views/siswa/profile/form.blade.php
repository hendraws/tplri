<div class="card card-accent-primary border-primary shadow-sm table-responsive">
    <form method="POST" action="{{ action('SiswaController@updateProfile') }}" enctype='multipart/form-data'>
        @csrf
        <div class="card-body">
            <div class="form-group row">
                <label for="nama" class="col-sm-2 col-form-label">Nama</label>
                <div class="col-md-10">
                    <input id="nama" type="text" class="form-control bg-white" name="nama" value="{{ $user->name }}"
                        required autocomplete="off" readonly disable>
                </div>
            </div>
            <div class="form-group row">
                <label for="tempat_lahir" class="col-sm-2 col-form-label">Tempat Lahir</label>
                <div class="col-md-4">
                    <input id="tempat_lahir" type="text" class="form-control @error('tempat_lahir') is-invalid @enderror"
                        name="tempat_lahir" value="{{ $user->tempat_lahir }}" required autocomplete="off"
                        placeholder="Tempat Lahir">
                </div>
                <label for="tanggal_lahir" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                <div class="col-md-4">
                    <input id="tanggal_lahir" type="text"
                        class="form-control @error('tanggal_lahir') is-invalid @enderror datetime bg-white"
                        name="tanggal_lahir" value="{{ $user->tanggal_lahir }}" required autocomplete="off"
                        placeholder="Tanggal Lahir" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="alamat" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-md-10">
                    <input id="alamat" type="text" class="form-control @error('alamat') is-invalid @enderror"
                        name="alamat" value="{{ $user->alamat }}" required autocomplete="off" placeholder="Alamat">
                </div>
            </div>
            <div class="form-group row">
                <label for="telepon" class="col-sm-2 col-form-label">Telepon</label>
                <div class="col-md-10">
                    <input id="telepon" type="text" class="form-control @error('telepon') is-invalid @enderror"
                        name="telepon" pattern="[0-9]+" value="{{ $user->telepon }}" required autocomplete="off"
                        placeholder="telepon">
                </div>
            </div>
            <div class="form-group row">
                <label for="quote" class="col-sm-2 col-form-label">Quote</label>
                <div class="col-md-10">
                    <input id="quote" type="text" class="form-control @error('quote') is-invalid @enderror" name="motto"
                        value="{{ $user->motto }}" required autocomplete="off">
                </div>
            </div>

            <div class="form-group row">
                <label for="nama_program" class="col-sm-2 col-form-label">Program Akademik</label>
                <div class="col-md-10">
                    <select class="form-control select" name="program_id" id="programAkademik">

                        <option readonly selected value="">Pilih Program Akademik</option>
                        @foreach ($programAkademik as $key => $val)
                            <option value="{{ $key }}" {{ $user->program_id == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach

                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="nama_program" class="col-sm-2 col-form-label">Kelas</label>
                <div class="col-md-10">
                    <select class="form-control select" name="kelas_id" id="kelas">
                        @if(!empty($user->kelas_id))
                        <option readonly selected value="">Pilih Kelas</option>
                        @foreach ($kelas as $key => $val)
                        <option value="{{ $key }}" {{ $user->kelas_id == $key ? 'selected' : '' }}>{{ $val }}</option>
                        @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="judul" class="col-sm-2 col-form-label">Foto</label>
                <div class="col-md-10">
                    <img id="frame" src="{{ empty($user->foto) ?  asset('images/profile.png') :  Storage::url($user->foto) }}" width="200" height="200"
                        class="img-thumbnail" />
                    <div class="custom-file">
                        <input type="file" class="custom-file-input" id="customFile" name="foto" onchange="preview()"
                            accept="image/*">
                        <label class="custom-file-label" for="customFile">Pilih Foto</label>
                    </div>
                    <small class="form-text text-muted">* Ukuran Maksimal Foto 500Kb</small>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-brand btn-square btn-primary col">Simpan</button>
            </div>
        </div>
    </form>
</div>
<script>
    function preview() {
        console.log(frame.src);
        frame.src = URL.createObjectURL(event.target.files[0]);
    }
    $(function() {
        $("input[name='telepon']").on('input', function(e) {
            $(this).val($(this).val().replace(/[^0-9]/g, ''));
        });
    });
</script>
