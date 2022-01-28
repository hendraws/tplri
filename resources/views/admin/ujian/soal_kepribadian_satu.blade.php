@extends('layouts.app-admin')
@section('title', 'Pengaturan Ujian CAT - ' . $ujian->judul)
@section('css')
    <link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .text-inline {
            display: -webkit-box;
        }

    </style>
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

            $(document).on('click', '.pilih-soal', function() {
                if(confirm("Pilih Soal ini ?")) {
                    let id = $(this).data('id');
                    pilihSoal(id);
                }
                return false;
            })
        });

        $('.table').DataTable({
            "pageLength": 50
        });

        function pilihSoal(id) {

            let ujian_id = "{{ $ujian->id }}";
            $.ajax({
                type: 'POST',
                url: "{{ action('UjianController@simpanSoal') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id_soal": id,
                    "id_ujian": ujian_id,
                    "kategori": 'kepribadian_satu',
                },
                success: function(data) {
                    if (data.code == '200') {
                        Swal.fire(
                            'Berhasil!',
                            'Soal Berhasil Ditambah.',
                            'success'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }
                }
            });

        }
    </script>
@endsection
@section('button-title')
    <a class="btn btn-sm btn-secondary ml-2 float-right" href="{{ action('UjianController@show', $ujian->id) }}" data-toggle="tooltip"
        data-placement="top" title="Kembali">Kembali</a>
@endsection
@section('content')
    <div class="card card-accent-primary border-primary shadow-sm table-responsive">
        <div class="card-header">
            <h5>Tambah Soal Kepribadian Satu </h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered display nowrap table-sm" width="100%">
                <thead>
                    <tr class="text-center">
                        <th scope="col">No</th>
                        <th scope="col">soal</th>
                        <th scope="col">jawaban</th>
                        <th scope="col">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $soal)
                        <tr >
                            <th>{{ $loop->index + 1 }}</th>
                            <td>{!! $soal->pertanyaan !!}</td>
                            <td class="text-inline">{{ $soal->getJawaban->pilihan }}. {!! $soal->getJawaban->jawaban !!}
                            </td>
                            <td class="text-center">
                                <a href="javascript:void(0)" class="btn btn-xs btn-primary pilih-soal"
                                    data-id="{{ $soal->id }}">Pilih Soal</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

@endsection
