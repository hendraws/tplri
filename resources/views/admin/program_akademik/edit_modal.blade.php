<form method="POST" action="{{ action('ProgramAkademikController@update', $programAkademik) }}">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Program Akademik Baru</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
        @method('PUT')
        {{-- {{ dd($programAkademik) }} --}}
		<div class="form-group row">
			<label for="nama_program" class="col-sm-4 col-form-label">Program Akademik</label>
			<div class="col-md-8">
                <input id="nama_program" type="text" class="form-control @error('nama_program') is-invalid @enderror" name="nama_program"
                value="{{ $programAkademik->nama_program }}" required autofocus ">
			</div>
		</div>

	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>
	</div>
</form>
