<form method="POST" action="{{ action('MataPelajaranController@update', $matapelajaran) }}">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Edit Mata Pelajaran</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
        @method('PUT')
		<div class="form-group row">
			<label for="nama_mapel" class="col-sm-4 col-form-label">Nama Mata Pelajaran</label>
			<div class="col-md-8">
                <input id="nama_mapel" type="text" class="form-control @error('nama_mapel') is-invalid @enderror" name="nama_mapel"
                value="{{ $matapelajaran->nama_mapel }}" required autofocus ">
			</div>
		</div>

	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>
	</div>
</form>
