@extends('layouts.app-admin')
@section('title', 'Edit Soal Mapel ' . $mapel->nama_mapel)
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
        <form method="POST" action="{{ action('SoalController@update', $soal) }}" enctype='multipart/form-data'>
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group row">
                    <label for="nama_program" class="col-sm-2 col-form-label">Pertanyaan</label>
                    <div class="col-md-12">
                        <textarea class="form-control text-editor" id="pertanyaan" rows="1"
                            name="pertanyaan">{!! $soal->pertanyaan !!}</textarea>
                    </div>
                </div>
                <div class="row">
                    @foreach ($soal->getJawaban as $item )
                    <div class="col-6 border">
                        <div class="form-group">
                            <label class="col-form-label">Pilihan {{ strtoupper($item->pilihan) }}</label>
                            <textarea class="form-control text-editor" id="textarea-a-1" rows="1" name="jawaban[{{ $item->pilihan }}]">{!! $item->jawaban !!}</textarea>
                            <div class="form-group row mt-2">
                                <label for="bobot" class="col-sm-4 col-form-label">Bobot Jawaban</label>
                                <div class="col-sm-8">
                                    <input type="number" class="form-control" name="bobot[{{ $item->pilihan }}]" value="{{ $item->bobot_nilai }}">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="col-6 align-self-center text-center h5 ">
                        <label class="col-form-label">Jawaban Benar</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="A" value="a" {{ $soal->jawaban_benar == 'a' ? 'checked' : '' }}>
                                <label class="form-check-label" for="A">A</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="B" value="b" {{ $soal->jawaban_benar == 'b' ? 'checked' : '' }}>
                                <label class="form-check-label" for="B">B</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="C" value="c" {{ $soal->jawaban_benar == 'c' ? 'checked' : '' }}>
                                <label class="form-check-label" for="C">C</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="D" value="d" {{ $soal->jawaban_benar == 'd' ? 'checked' : '' }}>
                                <label class="form-check-label" for="D">D</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="E" value="e" {{ $soal->jawaban_benar == 'e' ? 'checked' : '' }}>
                                <label class="form-check-label" for="E">E</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="All" value="i" {{ $soal->jawaban_benar == 'i' ? 'checked' : '' }}>
                                <label class="form-check-label" for="All">Benar Semua</label>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="mapel_id" value="{{ $mapel->id }}">
                <div class="modal-footer">
                    <button class="btn btn-brand btn-square btn-primary col">Simpan</button>
                </div>
            </div>
        </form>
    </div>

@endsection
