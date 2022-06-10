@extends('layouts.app-admin')
@section('title', 'Daftar Riwayat Ujian Siswa')
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
                            <th scope="col" class="align-middle" width="">Tanggal</th>
                            <th scope="col" class="align-middle" width="30%">Nama</th>
                            <th scope="col" class="align-middle" width="10%">Token</th>
                            <th scope="col" class="align-middle" width="10%">TWK</th>
                            <th scope="col" class="align-middle" width="10%">TIU</th>
                            <th scope="col" class="align-middle" width="10%">TKP</th>
                            <th scope="col" class="align-middle" width="10%">Total</th>
                            {{-- <th scope="col" class="align-middle" width="">Detail Ujian</th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $key => $value)
                        <tr >
                            <td class="text-center">{{ $value->updated_at }}</td>
                            <th scope="row"><a href="{{ action('IkdinUjianNilaiController@show', $value->id) }}">{{ optional($value->getSiswa)->name }}</a></th>
                            <td class="text-right">{{ $value->token }}</td>
                            <td class="text-right">{{ optional($value->getNilai)->twk }}</td>
                            <td class="text-right">{{ optional($value->getNilai)->tiu }}</td>
                            <td class="text-right">{{ optional($value->getNilai)->tkp }}</td>
                            <td class="text-right">{{ optional($value->getNilai)->nilai_akhir }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>

@endsection
