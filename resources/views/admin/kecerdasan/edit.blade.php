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
        <form method="POST" action="{{ action('KecerdasanController@update',$kecerdasan) }}" enctype='multipart/form-data'>
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="jenis_soal" class="col-sm-2 col-form-label ">Kategori Soal</label>
                    <div class="col-sm-12">
                        <select class="form-control" id="jenis_soal" name="kategori">
                            @foreach ($kategori as $key => $val)
                                <option value="{{ $key }}" {{ $kecerdasan->kategori == $key ? 'selected' : '' }}>{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="nama_program" class="col-sm-2 col-form-label">Pertanyaan</label>
                    <div class="col-md-12">
                        <textarea class="form-control text-editor" id="pertanyaan" rows="1" name="pertanyaan">
                            {!! $kecerdasan->pertanyaan !!}
                        </textarea>
                    </div>
                </div>
                {{-- {{ dd() }} --}}
                <div class="row">
                    @foreach ($kecerdasan->getPilihan as $value )
                    <div class="col-6 border">
                        <div class="form-group">
                            <label class="col-form-label">Pilihan {{ strtoupper($value->pilihan) }}</label>
                            <textarea class="form-control text-editor" id="textarea-a-1" rows="1"
                                name="jawaban[{{ $value->pilihan }}]">
                            {{ $value->jawaban }}
                            </textarea>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-6 align-self-center text-center h5 ">
                        <label class="col-form-label">Jawaban Benar</label>
                        <div class="col-md-12">
                            @php
                            $pilihan = ['a','b','c','d','e'];
                            @endphp
                            @foreach ($pilihan as $val )
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="{{ $val }}" value="{{ $val }}" {{ optional($kecerdasan->getJawaban)->pilihan == $val ? 'checked' : '' }}>
                                <label class="form-check-label" for="{{ $val }}">{{ $val }}</label>
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
