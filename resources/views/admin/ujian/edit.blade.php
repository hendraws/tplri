@extends('layouts.app-admin')
@section('title', 'Pembuatan Ujian CAT')
@section('css')
    <link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            // $(document).on('change', '#programAkademik', function() {
            //     console.log('{{ url()->full() }}');
            //     $.ajax({
            //         url: "{{ url()->full() }}",
            //         type: 'GET',
            //         data: {
            //             program_akademik_id: $(this).val(),
            //         },
            //         contentType: 'application/json; charset=utf-8',
            //         success: function(response) {
            //             $("#kelas").empty();
            //             $.each(response, function(key, value) {
            //                 $("#kelas").append('<option value=' + key + '>' + value +
            //                     '</option>');
            //             });
            //         },
            //         error: function() {
            //             alert("error");
            //         }
            //     });
            // })

            $('.datetime').datetimepicker({
                step: 10,
                minTime:'06:00',
                maxTime:'22:00',
            });

        })
    </script>
@endsection
@section('button-title')
<a class="btn btn-sm btn-secondary ml-2 float-right" href="{{ action('UjianController@index') }}"  >Kembali </a>
@endsection
@section('content')
    <div class="card card-accent-primary border-primary shadow-sm table-responsive">
        <form method="POST" action="{{ action('UjianController@update', $pengaturan_ujian) }}" enctype='multipart/form-data' b>
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                    <div class="col-md-10">
                        <input id="judul" type="text" class="form-control @error('judul') is-invalid @enderror"
                            name="judul" value="{{ $pengaturan_ujian->judul }}" required autocomplete="judul" autofocus
                            placeholder="Judul">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="token" class="col-sm-2 col-form-label">Token</label>
                    <div class="col-md-10">
                        <input id="token" type="text" class="form-control @error('token') is-invalid @enderror"
                            name="token" value="{{ $pengaturan_ujian->token }}" required autocomplete="token" autofocus
                            placeholder="Token">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-brand btn-square btn-primary col">Simpan</button>
                </div>
            </div>
        </form>
    </div>
@endsection
