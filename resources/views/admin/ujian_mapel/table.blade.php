<div class="table-responsive">
	<table class="table" style="font-size: 13px;">
		<thead class="thead-dark">
			<tr class="text-center">
				<th scope="col">Mata Pelajaran</th>
				<th scope="col">Jumlah Soal</th>
				<th scope="col">Passing Grade</th>
				<th scope="col">aksi</th>
			</tr>
		</thead>
		<tbody>
			@forelse ($data as $item)
            <tr>
                <td class="text-center">{{ optional($item->getMataPelajaran)->nama_mapel }}</td>
                <td class="text-center">{{ $item->get_soal_count }}</td>
                <td class="text-center">{{ $item->passing_grade }}</td>
                <td class="text-center">
                    <a class="btn btn-xs btn-primary" href="{{ action('UjianSoalController@index') }}?ujianmapel={{ $item->id }}"   data-toggle="tooltip" data-placement="top" title="Detail Soal" data-id="{{ $item->id }}" >Detail Soal</a>
                    <a class="btn btn-xs btn-warning modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="{{ action('MataPelajaranController@edit', $item) }}"  data-toggle="tooltip" data-placement="top" title="Edit Passing Grade" data-id="{{ $item->id }}" >Edit Passing Grade</a>
                    <a class="btn btn-xs btn-info modal-button" href="Javascript:void(0)"  data-target="ModalForm" data-url="{{ action('MataPelajaranController@edit', $item) }}"  data-toggle="tooltip" data-placement="top" title="Hapus" data-id="{{ $item->id }}" >Hapus</a>
                </td>
            </tr>
			@empty
			<tr>
				<td class="text-center text-bold bg-secondary" colspan="9"><h5>TIDAK ADA DATA</h5></td>
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
