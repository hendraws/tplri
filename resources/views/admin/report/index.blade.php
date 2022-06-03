@extends('layouts.app-admin')
@section('title', 'Report CAT SKD')
@section('css')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
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
    <script src="{{ asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
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

            $('.datetime').datetimepicker({
                timepicker: false,
                format: 'Y-m-d',
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

            $('#judul_cat').select2({
                multiple: true,
                theme: "bootstrap4",
                ajax: {
                url: "{{ action('ReportController@index') }}?data=judul",
                method: 'GET',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (d) {
                            return {
                                id: d.id,
                                text: d.judul +' ( '+ d.token + ' )',
                                // children: $.map(d.jurusan, function (j) {
                                //     return {
                                //         id: j.id,
                                //         text: j.kode_jurusan+' - '+j.name,
                                //     }
                                // })
                            }
                        })
                    };
                },
                cache: true,
                },
            })
            $('#kelas').select2({
                multiple: true,
                theme: "bootstrap4",
                ajax: {
                url: "{{ action('ReportController@index') }}?data=kelas",
                method: 'GET',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results:  $.map(data, function (d) {
                            return {
                                id: d.id,
                                text: d.nama_kelas ,
                                // children: $.map(d.jurusan, function (j) {
                                //     return {
                                //         id: j.id,
                                //         text: j.kode_jurusan+' - '+j.name,
                                //     }
                                // })
                            }
                        })
                    };
                },
                cache: true,
                },
            })
        });
    </script>
@endsection
@section('content')
    <div class="card">
        <div class="card-header">
            <a class="btn btn-primary float-right" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                aria-controls="collapseExample">
                <i class="fa fa-filter"></i> Filter
            </a>
            <a class="btn btn-warning float-right mx-2" href="{{ action('ReportController@index') }}" >
                <i class="fa fa-recycle"></i> Reset Filter
            </a>
        </div>
        <div class="collapse" id="collapseExample">
            <div class="card-body">
                <form action="" method="GET">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Dari Tanggal</label>
                            <input type="text" class="form-control datetime" autocomplete="off" id="from" name="from">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Sampai Tanggal</label>
                            <input type="text" class="form-control datetime" autocomplete="off" id="until" name="until">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Judul CAT</label>
                            <select class="form-control" id="judul_cat" name="judul_cat">
                              </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputPassword4">Kelas</label>
                            <select class="form-control" id="kelas" name="kelas">
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button class="btn btn-success col-12">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


    </div>
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
