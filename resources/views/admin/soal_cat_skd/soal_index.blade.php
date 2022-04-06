@extends('layouts.app-admin')
@section('title', 'Daftar Soal Mapel '. $mapel->nama_mapel)
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
			var url = $(this).data('url');
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
                                setTimeout(function(){ window.location = "{{url()->full() }}"; }, 1500);

							}else{
                                Swal.fire({title: 'data.message', icon: 'warning', toast: true, position: 'top-end', showConfirmButton: false, timer: 5000, timerProgressBar: true,});
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
<a class="btn btn-sm btn-primary float-right ml-2" href="{{ action('SoalController@create', ['mpi'=>$mapel->id]) }}"  data-target="ModalForm"  data-toggle="tooltip" data-placement="top" title="Tambah" >Tambah Soal</a>
@endsection
@section('content')
<div class="card card-accent-primary border-primary shadow-sm table-responsive pb-0 mb-0">
    <div id="showTable">

	</div>

</div>
@endsection
