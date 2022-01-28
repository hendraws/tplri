@extends('layouts.app-admin')
@section('title', 'Tambah Soal Kecerdasan')
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
            $('.table').DataTable({
                "autoWidth": false
            });
            $('input[type=file]').attr("disabled", true);
            $('.text-editor').summernote({
                height: 100,
                maximumImageFileSize: 512000, // 500 KB
                callbacks: {
                    onImageUploadError: function(msg) {
                        Swal.fire({
                            title: msg + ' (max: 500kb)',
                            icon: 'warning',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 5000,
                            timerProgressBar: true,
                        });
                    }
                }
            });
        });
    </script>
@endsection
@section('button-title')
@endsection
@section('content')
    {{-- <div class="card">
        <div class="card-header">
            Symbol
        </div>
        <div class="card-body">
            @include('admin.kecermatan.symbol')
        </div>

    </div> --}}
    <div class="card card-accent-primary border-primary shadow-sm table-responsive">
        <form method="POST" action="{{ action('KecermatanController@store') }}" enctype='multipart/form-data'>
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="soal_a" class="col-sm-2 col-form-label">A</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="" name="soal_a" id="soal_a">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="soal_b" class="col-sm-2 col-form-label">B</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="" name="soal_b" id="soal_b">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="soal_c" class="col-sm-2 col-form-label">C</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="" name="soal_c" id="soal_c">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="soal_d" class="col-sm-2 col-form-label">D</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="" name="soal_d" id="soal_d">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="soal_e" class="col-sm-2 col-form-label">E</label>
                    <div class="col-md-6">
                        <input type="text" class="form-control" placeholder="" name="soal_e" id="soal_e">
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-brand btn-square btn-primary col">Simpan</button>
                </div>
            </div>
        </form>
    </div>

@endsection
