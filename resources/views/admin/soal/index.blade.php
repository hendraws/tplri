@extends('layouts.app-admin')
@section('title', 'Mata Pelajaran')
@section('css')
<link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('js')
<script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
<script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});

		var url = "{{ url()->full() }}";
		getDataTable(url, "#showTable");

		$(document).on('click', '.pagination li a.page-link',function(event){
			event.preventDefault();

			$('li').removeClass('active');
			$(this).parent('li').addClass('active');

			var myurl = $(this).attr('href');
			var page=$(this).attr('href').split('page=')[1];

			getDataTable(myurl, '#showTable');
		})

        $(document).on('click','.hapus',function(e){
			e.preventDefault();
            var tag = $(this);
			var id = $(this).data('id');
			var url = '{{ action('MataPelajaranController@destroy',':id') }}';
			url = url.replace(':id',id);
			Swal.fire({
				title: 'Apakah Anda Yakin ?',
				text: "Data akan terhapus tidak dapat dikembalikan lagi !",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Yes, delete it!'
			}).then((result) => {
				if (result.value == true) {
					$.ajax({
						type:'DELETE',
						url:url,
						data:{
							"_token": "{{ csrf_token() }}",
						},
						success:function(data) {
							if (data.code == '200'){
								Swal.fire(
									'Deleted!',
									'Your file has been deleted.',
									'success'
									);
                                setTimeout(function(){ window.location = "{{ action('MataPelajaranController@index') }}"; }, 1500);

							}
						}
					});

				}
			})
		}) //tutup

	});
</script>
@endsection
@section('button-title')
@endsection
@section('content')
<div class="card card-accent-primary border-primary shadow-sm table-responsive">
	<div class="table-responsive">
        <table class="table" style="font-size: 13px;">
            <thead class="thead-dark">
                <tr class="text-center">
                    <th scope="col">Nama Mata Pelajaran</th>
                    <th scope="col">Total Soal</th>
                    <th scope="col">aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($data as $item)
                <tr class="text-center">
                    <td>{{ $item->nama_mapel }}</td>
                    <td>{{ $item->getSoal->count() }}</td>
                    <td class="text-center">
                        <a class="btn btn-xs btn-primary" href="{{ action('SoalController@show', $item) }}" data-id="{{ $item->id }}" >Daftar Soal</a>
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
</div>

@endsection
