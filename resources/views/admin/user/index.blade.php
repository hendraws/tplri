@extends('layouts.app-admin')
@section('title', 'Manajement Pengguna')
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

        $('.table').DataTable({
                "order": []
            });

        $(document).on('click','.aktifkan',function(e){
			e.preventDefault();
            var tag = $(this);
			var url = $(this).data('url');
            var nama = $(this).data('nama');
            var status = $(this).data('status');
            if(status == 'Y'){
                status = 'non aktifkan !';
            }else{
                status = 'aktifkan !';
            }
			Swal.fire({
				title: 'Aktifkan Akun',
				title: "Akun "+ nama + " akan di "+status,
				icon: 'info',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Iya, ' + status,
			}).then((result) => {
				if (result.value == true) {
					$.ajax({
						type:'PUT',
						url:url,
						data:{
							"_token": "{{ csrf_token() }}",
						},
						success:function(data) {
							if (data.code == '200'){
								Swal.fire(
									'Berhasil!',
									'Data Telah Di Perbarui.',
									'Sukses'
									);
                                setTimeout(function(){ window.location = "{{ url()->full() }}"; }, 1500);

							}
						},
                        error: function(data){
                                alert(data.message);
                            }
					});

				}
			})
		}) //tutup

        $(document).on('click','.hapus',function(e){
			e.preventDefault();
            var tag = $(this);
			var url = $(this).data('url');
            var nama = $(this).data('nama');
			Swal.fire({
				title: 'Hapus Akun',
				title: "Akun "+ nama + " akan di hapus !",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Iya, Hapus!'
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
                                setTimeout(function(){ window.location = "{{ url()->full() }}"; }, 1500);

							}
						},
                        error: function(data){
                                alert(data.message);
                            }
					});

				}
			})
		}) //tutup

        $(document).on('click','.reset-password',function(e){
			e.preventDefault();
            var tag = $(this);
			var url = $(this).data('url');
            var nama = $(this).data('nama');
			Swal.fire({
				title: "Password "+ nama + " akan di Reset  !",
				text: "Password direset menjadi tanggal lahir (DDMMYYYY)",
				icon: 'warning',
				showCancelButton: true,
				confirmButtonColor: '#3085d6',
				cancelButtonColor: '#d33',
				confirmButtonText: 'Iya, Reset!'
			}).then((result) => {
				if (result.value == true) {
					$.ajax({
						type:'PUT',
						url:url,
						data:{
							"_token": "{{ csrf_token() }}",
						},
						success:function(data) {
							if (data.code == '200'){
								Swal.fire(
									'Berhasil Reset!',
									'success'
									);
                                setTimeout(function(){ window.location = "{{ url()->full() }}"; }, 1500);

							}
						},
                        error: function(data){
                                alert(data.message);
                            }
					});

				}
			})
		}) //tutup
	});
</script>
@endsection
@section('button-title')
{{-- <a class="btn btn-sm btn-primary modal-button ml-2 float-right" href="Javascript:void(0)"  data-target="ModalForm" data-url="{{ action([App\Http\Controllers\UserController::class, 'create']) }}"  data-toggle="tooltip" data-placement="top" title="Edit" >Tambah Pengguna</a> --}}
{{-- <button class="btn btn-primary float-right btn-sm" type="button" data-toggle="collapse" data-target="#collapseExample"
aria-expanded="false" aria-controls="collapseExample">
Tambah Pengguna
</button> --}}
{{-- <button class="btn btn-success float-right btn-sm mx-2" type="button" id="btnExport">
	Export Xlsx
</button> --}}
<a href="{{ action('UserController@nonakfitAll') }}" class="btn btn-sm btn-danger float-right" onclick="return confirm('Yakin dinonaktifkan?');">Non Akfitkan Semua Akun</a>
@endsection
@section('content')
<div class="card card-accent-primary border-primary shadow-sm table-responsive">
	<div id="showTable">
        @includeIf('admin.user.table')
	</div>
</div>

@endsection
