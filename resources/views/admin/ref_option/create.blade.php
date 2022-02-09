@extends('layouts.app-admin')
@section('title', 'Ref. Option 2')
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
        <form method="POST" action="{{ action('RefOptionController@store') }}" enctype='multipart/form-data'>
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="nama_program" class="col-sm-2 col-form-label">Option</label>
                    <div class="col-md-12">
                        <input required type="text" class="form-control" placeholder="Option" name="Option">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_program" class="col-sm-2 col-form-label">Modul</label>
                    <div class="col-md-12">
                        <input required type="text" class="form-control" placeholder="Modul" name="modul">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-brand btn-square btn-primary col">Simpan</button>
                </div>
            </div>
        </form>
    </div>

@endsection
