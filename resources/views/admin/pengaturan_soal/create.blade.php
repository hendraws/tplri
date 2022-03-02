@extends('layouts.app-admin')
@section('title', 'Tambah Soal Kepribadian Sesi 1')
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
<a href="{{ action('PengaturanSoalController@index') }}" class="btn btn-brand btn-square btn-secondary float-right">Kembali</a>
@endsection
@section('content')
    <div class="card card-accent-primary border-primary shadow-sm table-responsive">
        <form method="POST" action="{{ action('PengaturanSoalController@store') }}" enctype='multipart/form-data'>
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="kategori" class="col-sm-2 col-form-label ">Kategori</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="kategori" name="kategori">
                            @foreach ($kategori as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="nama_program" class="col-sm-2 col-form-label">jumlah Soal</label>
                    <div class="col-sm-4">
                        <input type="number" class="form-control" placeholder="" name="jumlah_soal">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-brand btn-square btn-primary mr-auto">Simpan</button>

                </div>
            </div>
        </form>
    </div>

@endsection
