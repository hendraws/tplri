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
        $(document).ready(function() {
            $('input[type=file]').attr("disabled", true);
            $('.text-editor').summernote({
                height: 100,
                maximumImageFileSize: 512000, // 500 KB
                callbacks:{
                    onImageUploadError: function(msg){
                        Swal.fire({title: msg + ' (max: 500kb)', icon: 'warning', toast: true, position: 'top-end', showConfirmButton: false, timer: 5000, timerProgressBar: true,});
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
        <form method="POST" action="{{ action('KepribadianController@store_sesi1') }}" enctype='multipart/form-data'>
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="nama_program" class="col-sm-2 col-form-label">Pertanyaan</label>
                    <div class="col-md-12">
                        <textarea class="form-control" id="pertanyaan" rows="3"
                            name="pertanyaan"></textarea>
                    </div>
                </div>
                <div class="row">
                    <h5>Jawaban Benar</h5>
                    <div class="col-12 align-self-center h5 ">
                        <div class="col-md-12">
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="A" value="1">
                                <label class="form-check-label" for="A">A. Sangat Tidak Setuju</label>
                            </div>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="B" value="2">
                                <label class="form-check-label" for="B">B. Tidak Setuju</label>
                            </div>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="C" value="3">
                                <label class="form-check-label" for="C">C. Netral</label>
                            </div>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="D" value="4">
                                <label class="form-check-label" for="D">D. Setuju</label>
                            </div>
                            <div class="form-check form-check">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="E" value="5">
                                <label class="form-check-label" for="E">E. Sangat Setuju</label>
                            </div>
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
