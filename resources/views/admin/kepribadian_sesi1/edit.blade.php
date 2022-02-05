@extends('layouts.app-admin')
@section('title', 'Edit Soal Kepribadian Sesi 1')
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
    <div class="card card-accent-primary border-primary shadow-sm table-responsive">
        <form method="POST" action="{{ action('KepribadianController@update_sesi1', $kepribadian) }}" enctype='multipart/form-data'>
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="nama_program" class="col-sm-2 col-form-label">Pertanyaan</label>
                    <div class="col-md-12">
                        <textarea class="form-control" id="pertanyaan" rows="3" name="pertanyaan">{!! $kepribadian->pertanyaan !!}</textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="jenis_soal" class="col-sm-2 col-form-label ">Jenis Soal</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="jenis_soal" name="jenis_soal">
                            <option value="Positif" {{ $kepribadian->jenis == 'Positif' ? 'selected' : '' }}>Positif</option>
                            <option value="Negatif" {{ $kepribadian->jenis == 'Negatif' ? 'selected' : '' }}>Negatif</option>
                          </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5>Jawaban</h5>
                    </div>
                    <div class="col-12 align-self-center">
                        <div class="col-md-12">
                            @foreach ($kepribadian->getPilihan as $val)
                            <div class="form-group row">
                                <label class="col-sm-1 col-form-label text-right">{{ $val->pilihan }}.</label>
                                <div class="col-sm-10 row">
                                    <input required type="text" class="form-control col-5" placeholder="jawaban" name="jawaban[{{ $val->pilihan }}][jawaban]" value="{{ $val->jawaban }}">
                                    <input required type="number" class="form-control col-5" placeholder="bobot"  min="1" max="5" name="jawaban[{{ $val->pilihan }}][bobot]" value="{{ $val->bobot }}">
                                </div>
                            </div>
                            @endforeach
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
