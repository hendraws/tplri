<div class="row mt-5">
    <ol>
        @foreach ($ujian->getSoal as $listSoal)
        <div {{ !$loop->first ? 'style=display:none;' : '' }} id="list-{{ $loop->index + 1 }}" class="list-soal">
            <div class="col-12">
                <li value="{{ $loop->index + 1 }}"> {!! optional($listSoal->getSoal)->pertanyaan !!} </li>
            </div>
            <div class="col-12">
                <ol type='A'>
                    @foreach ($listSoal->getPilihanJawaban as $pilihanGanda)
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="pilihan[{{ $pilihanGanda->soal_id }}]" id="pilihan-{{ $pilihanGanda->id }}" value="{{ $pilihanGanda->id }}">
                        <label class="form-check-label" for="pilihan-{{ $pilihanGanda->id }}">
                            <li class="ml-3">{!! $pilihanGanda->jawaban !!}</li>
                        </label>
                    </div>
                    @endforeach
                </ol>
            </div>
            <div class="col-12" >
                <a href="javascript:void(0)" class="btn btn-primary simpan" data-ujian="{{ $ujian->id }}" data-soal="{{ $listSoal->soal_id }}" data-urutan="{{ $loop->index + 1 }}" >Simpan & Lanjutkan</a>
                <a href="javascript:void(0)" class="btn btn-warning ragu" data-ujian="{{ $ujian->id }}" data-soal="{{ $listSoal->soal_id }}" data-urutan="{{ $loop->index + 1 }}" >Ragu</a>
                <a href="javascript:void(0)" class="btn btn-secondary kosongkan" data-ujian="{{ $ujian->id }}" data-soal="{{ $listSoal->soal_id }}" data-urutan="{{ $loop->index + 1 }}" >Kosongkan Pilihan</a>
            </div>
        </div>
        @endforeach
    </ol>
</div>
