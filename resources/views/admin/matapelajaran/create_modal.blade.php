<form method="POST" action="{{ action('MataPelajaranController@store') }}">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Mata Pelajaran Baru</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf

		<div class="form-group row">
			<label for="nama_mapel" class="col-sm-4 col-form-label">Nama Mata Pelajaran</label>
			<div class="col-md-8">
                <input id="nama_mapel" type="text" class="form-control @error('nama_mapel') is-invalid @enderror" name="nama_mapel"
                value="{{ old('nama_mapel') }}" required autocomplete="nama_mapel" autofocus placeholder="Mata Pelajaran">
			</div>
		</div>

	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>
	</div>
</form>
