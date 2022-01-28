<form method="POST" action="{{ action('KelasController@store') }}">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Kelas Baru</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf

		<div class="form-group row">
			<label for="program_akademik" class="col-sm-4 col-form-label">Program Akademik</label>
			<div class="col-md-8">
                <select class="form-control select" name="program_akademik_id" >
                    <option readonly selected value="">Pilih Program Akademik</option>
                    @foreach($programAkademik as $val)
                    <option value="{{ $val->id }}" >{{ $val->nama_program }}</option>
                    @endforeach
                </select>
			</div>
		</div>

		<div class="form-group row">
			<label for="kelas" class="col-sm-4 col-form-label">Nama Kelas</label>
			<div class="col-md-8">
                <input id="kelas" type="text" class="form-control @error('kelas') is-invalid @enderror" name="nama_kelas"
                value="{{ old('kelas') }}" required autocomplete="kelas" autofocus placeholder="Nama Kelas">
			</div>
		</div>

	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>
	</div>
</form>
