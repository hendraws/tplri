@extends('layouts.app-admin')
@section('title', 'Report CAT SKD')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('js')
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script type="text/javascript" language="javascript"
        src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.table').DataTable({
                "order": [],
                dom: 'Blfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
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
@section('content')
    <div class="card card-accent-primary border-primary shadow-sm table-responsive">
        <div id="showTable">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table" style="font-size: 13px;">
                        <thead class="thead-dark">
                            <tr class="text-center">
                                <th scope="col">Nama</th>
                                <th scope="col">Kelas</th>
                                <th scope="col">Token</th>
                                <th scope="col">Judul</th>
                                <th scope="col">TWK</th>
                                <th scope="col">TIU</th>
                                <th scope="col">TKP</th>
                                <th scope="col">Nilai Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $item)
                                <tr>
                                    <td>{{ optional($item->getSiswa)->name }}</td>
                                    <td>{{ optional(optional($item->getSiswa)->getKelas)->nama_kelas }}</td>
                                    <td>{{ $item->token }}</td>
                                    <td>{{ optional($item->getUjian)->judul }}</td>
                                    <td>{{ optional($item->getNilai)->twk }}</td>
                                    <td>{{ optional($item->getNilai)->tiu }}</td>
                                    <td>{{ optional($item->getNilai)->tkp }}</td>
                                    <td>{{ optional($item->getNilai)->nilai_akhir }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

@endsection
