@extends('layouts.app-admin')
@section('title', 'Daftar Test Psikologi POLRI')
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

            $(document).on('click', '.hapus', function(e) {
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
                            type: 'DELETE',
                            url: url,
                            data: {
                                "_token": "{{ csrf_token() }}",
                            },
                            success: function(data) {
                                if (data.code == '200') {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your file has been deleted.',
                                        'success'
                                    );
                                    setTimeout(function() {
                                        window.location =
                                            "{{ action('UjianController@index') }}";
                                    }, 1500);

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
{{-- #ff6200 --}}
@endsection
@section('content')
    <div class="card card-accent-primary border-primary shadow-sm table-responsive">
        <div id="showTable">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-sm">
                        <thead>
                        <tr class="bg-dark text-center">
                            <th scope="col" class="align-middle" width="30%">Nama</th>
                            <th scope="col" class="align-middle" width="10%">Kecerdasan</th>
                            <th scope="col" class="align-middle" width="10%">Kecermatan</th>
                            <th scope="col" class="align-middle" width="10%">Kepribadian</th>
                            <th scope="col" class="align-middle" width="10%">Nilai Akhir</th>
                            <th scope="col" class="align-middle" width="">Tanggal</th>
                            <th scope="col" class="align-middle" width="">Detail Ujian</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                        <tr >
                            <th scope="row">{{ optional(optional($value->getUjianSiswa)->getSiswa)->name }}</th>
                            <td class="text-right">{{ $value->kecerdasan }}</td>
                            <td class="text-right">{{ $value->kecermatan }}</td>
                            <td class="text-right">{{ $value->kepribadian }}</td>
                            <td class="text-right">{{ $value->nilai_akhir }}</td>
                            <td class="text-center">{{ optional($value->getUjianSiswa)->created_at }}</td>
                            <td class="text-center">
                                <a href="{{ action('UjianNilaiController@index') }}" class="btn btn-primary">Detail Test</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

@endsection
