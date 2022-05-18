@extends('layouts.app-siswa')
@section('title', 'Riwayat Ujian')
@section('css')
    <link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
    <style>
        .bg-white {
            background-color: white;
        }

    </style>
@endsection
@section('js')
    <script src="{{ asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.datetime').datetimepicker({
                timepicker: false,
                format: 'Y/m/d',
            });

            $(document).on('change', '#programAkademik', function() {
                $.ajax({
                    url: "{{ url()->full() }}",
                    type: 'GET',
                    data: {
                        program_akademik_id: $(this).val(),
                    },
                    contentType: 'application/json; charset=utf-8',
                    success: function(response) {
                        $("#kelas").empty();
                        $.each(response, function(key, value) {
                            $("#kelas").append('<option value=' + key + '>' + value +
                                '</option>');
                        });
                    },
                    error: function() {
                        alert("error");
                    }
                });
            });

        })
    </script>
@endsection
@section('content')

    <div class="card">
        <div class="card-body">
            <h5>Riwayat Ujian</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tanggal Ujian</th>
                            <th scope="col">Judul Ujian</th>
                            <th scope="col">TWK</th>
                            <th scope="col">TIU</th>
                            <th scope="col">TKP</th>
                            <th scope="col">TOTAL</th>
                            {{-- <th scope="col"></th> --}}
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $data as $value)
                        <tr>
                            <th scope="row">{{ $loop->index + 1 }}</th>
                            <td>{{ date('d M Y h:i:s', strtotime($value->created_at)) }}</td>
                            <td>{{ optional($value->getUjian)->judul  }}</td>
                            <td>{{ optional($value->getNilai)->twk }}</td>
                            <td>{{ optional($value->getNilai)->tiu }}</td>
                            <td>{{ optional($value->getNilai)->tkp }}</td>
                            <td>{{ optional($value->getNilai)->nilai_akhir }}</td>
                            {{-- <td><a href="">Detail</a></td> --}}
                        </tr>
                        @endforeach

                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer">
            <a href="/" class="btn btn-info col-12">Kembali</a>
        </div>
    </div>

@endsection
