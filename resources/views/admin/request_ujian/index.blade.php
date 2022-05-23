@extends('layouts.app-admin')
@section('title', 'Verifikasi Pengguna Ujian')
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

            $(document).on('click', '.permission', function(e) {
                e.preventDefault();
                var tag = $(this);
                var url = $(this).data('url');
                var status = $(this).data('status');
                var name = $(this).data('name');
                Swal.fire({
                    title: 'Yakin '+ name + ' ?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Iya, Yakin!'
                }).then((result) => {
                    if (result.value == true) {
                        $.ajax({
                            type: 'PUT',
                            url: url,
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "status_akses": status,
                            },
                            success: function(data) {
                                if (data.code == '200') {
                                    Swal.fire(
                                        'Berhasil!',
                                        '',
                                        'success'
                                    );
                                    setTimeout(function() {
                                        window.location =
                                            "{{ url()->full() }}";
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
    <a class="btn btn-sm btn-danger ml-2 float-right" href="{{ action('UjianController@create') }}" data-toggle="tooltip"
        data-placement="top" title="Tambah">TOLAK SEMUA</a>
    <a class="btn btn-sm btn-success ml-2 float-right" href="{{ action('UjianController@create') }}" data-toggle="tooltip"
        data-placement="top" title="Tambah">IJINKAN SEMUA</a>
@endsection
@section('content')
    <div class="card card-accent-primary border-primary shadow-sm table-responsive">
        <div id="showTable">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table" style="font-size: 13px;">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th scope="col">Nama Siswa</th>
                                <th scope="col">Email</th>
                                <th scope="col">TOKEN</th>
                                <th scope="col">Jenis CAT</th>
                                <th scope="col">Waktu</th>
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">
                                        {{ $item->getSiswa->name }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->getSiswa->email }}
                                    </td>
                                    <td class="text-center">
                                        <h5>{{ $item->token }}</h5>
                                    </td>
                                    <td class="text-center">{{ $item->getUjian->source }}</td>
                                    <td class="text-center">{{ $item->created_at }}</td>
                                    <td class="text-center">
                                        <a href="Javascript:void(0)" class="btn btn-xs btn-success permission success"
                                            data-url="{{ action('UjianSiswaController@approvalUjian', $item->id) }}"
                                            data-status="1" data-name="di Ijinkan">Ijinkan</a>
                                        <a href="Javascript:void(0)" class="btn btn-xs btn-danger permission danger"
                                            data-url="{{ action('UjianSiswaController@approvalUjian', $item->id) }}"
                                            data-status="2" data-name="di Tolak">Tolak</a>
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
