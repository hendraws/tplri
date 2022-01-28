<form method="POST" action="{{ action('KelasController@update', $kela) }}">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Edit Kelas</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
        @method('PUT')
        <div class="form-group row">
			<label for="program_akademik" class="col-sm-4 col-form-label">Program Akademik</label>
			<div class="col-md-8">
                <select class="form-control select" name="program_akademik_id" >
                    <option readonly selected value="">Pilih Program Akademik</option>
                    @foreach($programAkademik as $val)
                    <option value="{{ $val->id }}" {{  $val->id == $kela->program_akademik_id ? 'selected' : '' }}>{{ $val->nama_program }}</option>
                    @endforeach
                </select>
			</div>
		</div>
        {{-- {{ dd($programAkademik) }} --}}
		<div class="form-group row">
			<label for="nama_kelas" class="col-sm-4 col-form-label">Nama Kelas</label>
			<div class="col-md-8">
                <input id="nama_kelas" type="text" class="form-control @error('nama_kelas') is-invalid @enderror" name="nama_kelas"
                value="{{ $kela->nama_kelas }}" required autofocus ">
			</div>
		</div>

	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>
	</div>
</form>
