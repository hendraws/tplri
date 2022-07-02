@extends('layouts.app-admin')
@section('title', 'Ujian Psikologi POLRI')
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

            $(document).on('click', '.aktifkan', function(e) {
                e.preventDefault();
                var tag = $(this);
                var url = $(this).data('url');
                var status = $(this).data('status');
                Swal.fire({
                    title: 'Apakah Anda Yakin Ubah Status?',
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
                                "is_active": status,
                            },
                            success: function(data) {
                                if (data.code == '200') {
                                    Swal.fire(
                                        'Berhasil!',
                                        'Data Sudah Di Perbarui.',
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
    <a class="btn btn-sm btn-primary ml-2 float-right" href="{{ action('UjianController@create') }}" data-toggle="tooltip"
        data-placement="top" title="Tambah">Buat Ujian Baru</a>
@endsection
@section('content')
    <div class="card card-accent-primary border-primary shadow-sm table-responsive">
        <div id="showTable">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table" style="font-size: 13px;">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th scope="col">Token</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Aktif?</th>
                                <th scope="col">Posisi</th>
                                <th scope="col">mapel</th>
                                {{-- <th scope="col">Soal</th> --}}
                                <th scope="col">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td class="text-center">
                                        <h5>{{ $item->token }}</h5>
                                    </td>
                                    <td>{{ $item->judul }}</td>
                                    <td class="text-center">{{ $item->is_active == '1' ? 'Aktif' : 'Tidak Aktif' }}</td>
                                    <td class="text-center">{{ $item->posisi }}</td>
                                    <td class="text-center">{{ $item->kategori }}</td>
                                    <td class="text-center">
                                        {{-- <a class="btn btn-xs btn-primary"
                                            href="{{ action('UjianController@show', $item) }}" data-toggle="tooltip"
                                            data-placement="top" title="Detail" data-id="{{ $item->id }}">Detail</a> --}}
                                        <a class="btn btn-xs btn-warning"
                                            href="{{ action('UjianController@edit', $item) }}" data-toggle="tooltip"
                                            data-placement="top" title="Edit" data-id="{{ $item->id }}">Edit</a>
                                        <a class="btn btn-xs btn-info"
                                            href="{{ action('UjianController@generate', $item->id) }}"
                                            data-toggle="tooltip" data-placement="top" title="Generate"
                                            data-id="{{ $item->id }}">Generate</a>
                                        @if ($item->is_active == '0')
                                            <a href="Javascript:void(0)"
                                                class="btn btn-xs btn-primary aktifkan bg-purple color-palette"
                                                data-url="{{ action('UjianController@is_active', $item) }}"
                                                data-status="{{ $item->is_active }}">Aktifkan</a>
                                        @else
                                            <a href="Javascript:void(0)"
                                                class="btn btn-xs btn-info aktifkan bg-purple color-palette"
                                                data-url="{{ action('UjianController@is_active', $item) }}"
                                                data-status="{{ $item->is_active }}">Non
                                                Akfitkan</a>
                                        @endif
                                        <a href="Javascript:void(0)" class="btn btn-xs btn-danger hapus"
                                            data-url="{{ action('UjianController@destroy', $item) }}">Hapus</a>

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
