@extends('layouts.app-admin')
@section('title', 'Edit Soal Kepribadian Sesi 2')
@section('css')
    <link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection
@section('js')
    <script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">

    </script>
@endsection
@section('button-title')
@endsection
@section('content')
    <div class="card card-accent-primary border-primary shadow-sm table-responsive">
        <form method="POST" action="{{ action('KepribadianController@update_sesi2', $kepribadian) }}" enctype='multipart/form-data'>
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="nama_program" class="col-sm-2 col-form-label">Pertanyaan</label>
                    <div class="col-md-12">
                        <textarea class="form-control" id="pertanyaan" rows="3" name="pertanyaan">{{ $kepribadian->pertanyaan }}</textarea>
                    </div>
                </div>
                <div class="col-12 align-self-center h5 ">
                    <div class="col-md-12">
                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="jawaban_benar" id="A" value="6" {{ $kepribadian->jawaban_id == 6 ? 'checked' : '' }}>
                            <label class="form-check-label" for="A">A. Iya</label>
                        </div>
                        <div class="form-check form-check">
                            <input class="form-check-input" type="radio" name="jawaban_benar" id="B" value="7"  {{ $kepribadian->jawaban_id == 7 ? 'checked' : '' }}>
                            <label class="form-check-label" for="B">B. Tidak</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-brand btn-square btn-primary col">Simpan</button>
                </div>
            </div>
        </form>
    </div>

@endsection
