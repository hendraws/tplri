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
            $('input[type=file]').attr("disabled", true);
            $('.text-editor').summernote({
                height: 100,
                toolbar: [
                    // ['style', ['style']],
                    ['font', ['bold', 'underline', 'superscript', 'subscript', 'clear', ]],
                    // ['fontname', ['fontname']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['table', ['table']],
                    ['insert', ['picture']],
                    //   ['view', ['fullscreen', 'codeview', 'help']],
                ],
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
                    },
                    onPaste: function(e) {
                        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData)
                            .getData('Text');
                        e.preventDefault();
                        document.execCommand('insertText', false, bufferText);
                    }
                },
            });
        });
    </script>
@endsection
@section('button-title')
@endsection
@section('content')
    <div class="card card-accent-primary border-primary shadow-sm table-responsive">
        <form method="POST" action="{{ action('KecerdasanController@store') }}" enctype='multipart/form-data'>
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="jenis_soal" class="col-sm-2 col-form-label ">Kategori Soal</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="jenis_soal" name="kategori">
                            @foreach ($kategori as $key => $val)
                                <option value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_program" class="col-sm-2 col-form-label">Pertanyaan</label>
                    <div class="col-md-12">
                        <textarea class="form-control text-editor" id="pertanyaan" rows="1" name="pertanyaan"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 border">
                        <div class="form-group">
                            <label class="col-form-label">Pilihan A</label>
                            <textarea class="form-control text-editor" id="textarea-a-1" rows="1"
                                name="jawaban[a]"></textarea>
                        </div>
                    </div>
                    <div class="col-6 border">
                        <div class="form-group">
                            <label class="col-form-label">Pilihan B</label>
                            <textarea class="form-control text-editor" id="textarea-b-1" rows="1"
                                name="jawaban[b]"></textarea>

                        </div>
                    </div>
                    <div class="col-6 border">
                        <div class="form-group">
                            <label class="col-form-label">Pilihan C</label>
                            <textarea class="form-control text-editor" id="textarea-c-1" rows="1"
                                name="jawaban[c]"></textarea>

                        </div>
                    </div>
                    <div class="col-6 border">
                        <div class="form-group">
                            <label class="col-form-label">Pilihan D</label>
                            <textarea class="form-control text-editor" id="textarea-d-1" rows="1"
                                name="jawaban[d]"></textarea>

                        </div>
                    </div>
                    <div class="col-6 border">
                        <div class="form-group">
                            <label class="col-form-label">Pilihan E</label>
                            <textarea class="form-control text-editor" id="textarea-e-1" rows="1"
                                name="jawaban[e]"></textarea>

                        </div>
                    </div>
                    <div class="col-6 align-self-center text-center h5 ">
                        <label class="col-form-label">Jawaban Benar</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="A" value="a">
                                <label class="form-check-label" for="A">A</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="B" value="b">
                                <label class="form-check-label" for="B">B</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="C" value="c">
                                <label class="form-check-label" for="C">C</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="D" value="d">
                                <label class="form-check-label" for="D">D</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="E" value="e">
                                <label class="form-check-label" for="E">E</label>
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
