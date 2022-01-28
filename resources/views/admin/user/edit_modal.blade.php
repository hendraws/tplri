<form method="POST" action="{{ action([App\Http\Controllers\UserController::class, 'update'],['manajemen_pengguna' => $manajemen_pengguna]) }}">
	<div class="modal-header">
		<h5 class="modal-title" id="exampleModalLabel">Tambah Pengguna Baru</h5>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
		@csrf
        @method('PUT')
		<div class="form-group row">
			<label for="name" class="col-sm-4 col-form-label">Nama</label>
			<div class="col-md-8">
                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                value="{{ $manajemen_pengguna->name }}" required autocomplete="name" autofocus placeholder="name">
			</div>
		</div>

		<div class="form-group row">
			<label for="email" class="col-sm-4 col-form-label">Email</label>
			<div class="col-md-8">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                name="email" value="{{ $manajemen_pengguna->email }}" required autocomplete="email" placeholder="Email">
			</div>
		</div>

		{{-- <div class="form-group row">
			<label for="password" class="col-sm-4 col-form-label">Old Password</label>
			<div class="col-md-8">
                <input id="password" type="password"  placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
			</div>
		</div>
		<div class="form-group row">
			<label for="password" class="col-sm-4 col-form-label">Password</label>
			<div class="col-md-8">
                <input id="password" type="password"  placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
			</div>
		</div>
		<div class="form-group row">
			<label for="password-confirm" class="col-sm-4 col-form-label">Retype Password</label>
			<div class="col-md-8">
                <input id="password-confirm" type="password" placeholder="Retype password" class="form-control" name="password_confirmation" required autocomplete="new-password">
			</div>
		</div> --}}
        <div class="form-group row">
			<label for="is_active" class="col-sm-4 col-form-label">Aktif ?</label>
			<div class="col-sm-8">
				<div class="form-check">
					<input class="form-check-input" type="radio" name="is_active" id="exampleRadios1" value="Y" checked>
					<label class="form-check-label" for="exampleRadios1">
						Y
					</label>
				</div>
				<div class="form-check">
					<input class="form-check-input" type="radio" name="is_active" id="exampleRadios2" value="N">
					<label class="form-check-label" for="exampleRadios2">
						N
					</label>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
		<button class="btn btn-brand btn-square btn-primary">Simpan</button>
	</div>
</form>
