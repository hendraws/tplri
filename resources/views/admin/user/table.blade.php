<div class="table-responsive">
	<table class="table" style="font-size: 13px;">
		<thead class="thead-dark">
			<tr class="text-center">
				<th scope="col">Nama</th>
				<th scope="col">Email</th>
				<th scope="col">Aktif?</th>
				<th scope="col">Kelas</th>
				<th scope="col">Program</th>
				<th scope="col">aksi</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($data as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->email }}</td>
                <td>{{ $item->is_active }}</td>
                <td>{{ $item->kelas_id ?? '-' }}</td>
                <td>{{ $item->program_id ?? '-' }}</td>
                <td class="text-center">
                    @if($item->is_active == 'N')
                    <a href="Javascript:void(0)" class="btn btn-xs btn-primary aktifkan"  data-url="{{ action('UserController@aktifkanAkun', $item) }}"  data-status="{{ $item->is_active }}" data-nama="{{ $item->name }}">Aktifkan</a>
                    @else
                    <a href="Javascript:void(0)" class="btn btn-xs btn-info aktifkan"  data-url="{{ action('UserController@aktifkanAkun', $item) }}"  data-status="{{ $item->is_active }}" data-nama="{{ $item->name }}">Non Akfitkan</a>
                    @endif
                    <a class="btn btn-xs btn-warning modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="{{ action([App\Http\Controllers\UserController::class, 'edit'],['manajemen_pengguna' => $item]) }}"  data-toggle="tooltip" data-placement="top" title="Edit" data-id="{{ $item->id }}" >Edit</a>
                    <a href="Javascript:void(0)" class="btn btn-xs btn-danger hapus" data-url="{{ action('UserController@destroy', $item) }}" data-nama="{{ $item->name }}" ">Hapus</a>
                    <a href="Javascript:void(0)" class="btn btn-xs btn-secondary">Reset Password</a>
                </td>
            </tr>
			@empty
			<tr>
				<td class="text-center text-bold bg-secondary" colspan="7"><h5>TIDAK ADA DATA</h5></td>
			</tr>
			@endforelse
		</tbody>
	</table>

</div>
<div class="card-body p-2 border-top">
	<div class="row justify-content-between align-items-center">
		<div class="col-auto ml-auto">
			{!! $data->appends(request()->except('_token'))->links() !!}
		</div>
	</div>
</div>
