@extends('layouts.app-admin')
@section('title', 'Kecerdasan')
@section('css')
    <link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendors/DataTables/Responsive-2.2.6/css/responsive.dataTables.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.table').DataTable({
                // responsive: {
                //     details: {
                //         type: 'column'
                //     }
                // },
                // columnDefs: [{
                //     className: 'dtr-control',
                //     orderable: false,
                //     targets: 0
                // }],
                bAutoWidth: false,
                aoColumns: [{
                        sWidth: '15%'
                    },
                    {
                        sWidth: '15%'
                    },
                    {
                        sWidth: '15%'
                    },
                    {
                        sWidth: '15%'
                    },
                    {
                        sWidth: '15%'
                    },
                    {
                        sWidth: '15%'
                    },
                    {
                        sWidth: '10%'
                    },
                    {
                        sWidth: '10%'
                    }
                ],

                // order: [1, 'asc']
            });

            $(document).on('click', '.hapus', function(e) {
                e.preventDefault();
                var tag = $(this);
                var id = $(this).data('id');
                var url = '{{ action('KelasController@destroy', ':id') }}';
                url = url.replace(':id', id);
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
                                            "{{ action('KelasController@index') }}";
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
    <a class="btn btn-sm btn-primary  ml-2 float-right" href="{{ action('KecerdasanController@create') }}"
        data-toggle="tooltip" data-placement="top" title="Tambah">Tambah
        Soal Kecerdasan</a>

@endsection
@section('content')
    <div class="card card-accent-primary border-primary shadow-sm">
        <div id="showTable" class="card-body table-responsive">
            <table class="table table-bordered display nowrap table-sm" width="100%">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">soal</th>
                        <th scope="col">A</th>
                        <th scope="col">B</th>
                        <th scope="col">C</th>
                        <th scope="col">D</th>
                        <th scope="col">E</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kecerdasan as $data)
                        <tr>
                            <th>{{ $loop->index + 1 }}</th>
                            <td>{!! $data->pertanyaan !!}</td>
                            @foreach ($data->getPilihan as $pilihan)
                                <td class="{{ $pilihan->benar == 'Y' ? 'bg-success' : '' }}"> {!! $pilihan->jawaban !!}
                                </td>
                            @endforeach
                            <td class="text-center">
                                <a href="" class="btn btn-xs btn-warning">Edit</a>
                                <a href="" class="btn btn-xs btn-danger">Hapus</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>


@endsection
