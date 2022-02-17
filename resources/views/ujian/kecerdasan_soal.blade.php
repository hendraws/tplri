<div class="row mt-5" id="content-soal">
    <ol>
        @foreach ($soalKecerdasan as $soal)
        <div {{ !$loop->first ? 'style=display:none;' : '' }} id="list-{{ $loop->index + 1 }}" class="list-soal">
            <h5>Soal</h5>
            <div class="col-12">
                <li value="{{ $loop->index + 1 }}"> {!! $soal->pertanyaan !!} </li>
            </div>
            <div class="col-12">
                <ol type='A' class='p-0'>
                    @foreach ($soal->getPilihan as $pilihanGanda)
                    <div class="form-check">
                        {{-- <input class="form-check-input" type="radio" name="pilihan[{{ $soal->id }}]" id="pilihan-{{ $pilihanGanda->id }}" value="{{ $pilihanGanda->id }}"> --}}
                        <label class="form-check-label" for="pilihan-{{ $pilihanGanda->id }}">
                            <li class="ml-3">{!! $pilihanGanda->jawaban !!}</li>
                        </label>
                    </div>
                    @endforeach
                </ol>
            </div>
            <h5 class="mt-5">Jawaban Anda</h5>
            <div class="col-12">
                <table>
                    <tr class="table  table-borderless">
                        @foreach ($soal->getPilihan as $pilihanGanda)
                            <td style="width: 20%">
                                <div class="form-check">
                                    <input class="form-check-input" type="radio"
                                        name="pilihan[{{ $soal->id }}]" id="pilihan-{{ $pilihanGanda->id }}"
                                        value="{{ $pilihanGanda->id }}" data-jb="{{ $soal->jawaban_id }}" >
                                    <label class="form-check-label" for="pilihan-{{ $pilihanGanda->id }}">
                                        {{ $pilihanGanda->pilihan }}
                                    </label>
                                </div>
                            </td>
                        @endforeach
                    </tr>
                </table>
            </div>
            <div class="col-12" >
                <a href="javascript:void(0)" class="btn btn-primary simpan" data-ujian="{{ $ujian->id }}" data-soal="{{ $soal->id }}" data-urutan="{{ $loop->index + 1 }}"  data-jb="{{ $soal->jawaban_id }}">Simpan</a>
                <a href="javascript:void(0)" class="btn btn-primary lanjutkan" data-ujian="{{ $ujian->id }}" data-soal="{{ $soal->id }}" data-urutan="{{ $loop->index + 1 }}" data-jb="{{ $soal->jawaban_id }}">Lanjutkan</a>
            </div>
        </div>
        @endforeach
    </ol>
</div>
