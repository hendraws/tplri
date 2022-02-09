<div class="row mt-5" id="content-soal">
    <ol>
        @foreach ($ujian->getSoalKecerdasan as $listSoal)
        <div {{ !$loop->first ? 'style=display:none;' : '' }} id="list-{{ $loop->index + 1 }}" class="list-soal">
            <div class="col-12">
                <li value="{{ $loop->index + 1 }}"> {!! $listSoal->pertanyaan !!} </li>
            </div>
            <div class="col-12">
                <ol type='A'>
                    @foreach ($listSoal->getPilihan as $pilihanGanda)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="pilihan[{{ $listSoal->id }}]" id="pilihan-{{ $pilihanGanda->id }}" value="{{ $pilihanGanda->id }}">
                        <label class="form-check-label" for="pilihan-{{ $pilihanGanda->id }}">
                            <li class="ml-3">{!! $pilihanGanda->jawaban !!}</li>
                        </label>
                    </div>
                    @endforeach
                </ol>
            </div>
            <div class="col-12" >

                <a href="javascript:void(0)" class="btn btn-primary simpan" data-ujian="{{ $ujian->id }}" data-soal="{{ $listSoal->id }}" data-urutan="{{ $loop->index + 1 }}" data-jb="{{ $listSoal->jawaban_id }}" >Simpan</a>
                <a href="javascript:void(0)" class="btn btn-primary lanjutkan" data-ujian="{{ $ujian->id }}" data-soal="{{ $listSoal->id }}" data-urutan="{{ $loop->index + 1 }}" data-jb="{{ $listSoal->jawaban_id }}" >Lanjutkan</a>
                {{-- <a href="javascript:void(0)" class="btn btn-warning ragu" data-ujian="{{ $ujian->id }}" data-soal="{{ $listSoal->id }}" data-urutan="{{ $loop->index + 1 }}"  data-jb="{{ $listSoal->jawaban_id }}" >Ragu</a>
                <a href="javascript:void(0)" class="btn btn-secondary kosongkan" data-ujian="{{ $ujian->id }}" data-soal="{{ $listSoal->id }}" data-urutan="{{ $loop->index + 1 }}" >Kosongkan Pilihan</a> --}}
            </div>
        </div>
        @endforeach
    </ol>
</div>
