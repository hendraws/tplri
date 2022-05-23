@if ($ujianSiswa->status_ujian == 0)
<div class="row mt-5">
    <div class="col-md-4">
        <div class="card">
            {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
            <div class="card-body ">
                <form method="POST" action="{{ action('UjianSiswaController@ujianKecerdasan') }}">
                    @csrf
                    <h5 class=" text-center">Test Kecerdasan</h5>
                    <input type="hidden" name="ujian_id" value="{{ $ujianSiswa->ujian_id }}">
                    <input type="hidden" name="ujian_siswa_id" value="{{ $ujianSiswa->id }}">
                    {{-- <button class="btn btn-secondary col-12 mt-4" disabled>Test Belum Tersedia</button> --}}
                    @if ($ujianSiswa->kecerdasan == 0)
                        <button type="submit" class="btn btn-primary col-12 mt-4"
                            onclick="return confirm('Mulai Test kecerdasan ?')">Mulai Test</button>
                    @elseIf($ujianSiswa->kecerdasan == 1)
                        <button class="btn btn-success col-12 mt-4" disabled>Selesai Test</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
            <div class="card-body">
                <form method="POST" action="{{ action('UjianSiswaController@ujianKecermatan') }}">
                    @csrf
                    <h5 class="text-center">Test Kecermatan</h5>
                    <input type="hidden" name="ujian_id" value="{{ $ujianSiswa->ujian_id }}">
                    <input type="hidden" name="ujian_siswa_id" value="{{ $ujianSiswa->id }}">
                    {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk
                of the card's content.</p> --}}
                    @if ($ujianSiswa->kecermatan == 0 && $ujianSiswa->kecerdasan == 0)
                        <button class="btn btn-secondary col-12 mt-4" disabled>Test Belum Tersedia</button>
                    @elseif($ujianSiswa->kecerdasan == 1 && $ujianSiswa->kecermatan == 0)
                        <button type="submit" class="btn btn-primary col-12 mt-4"
                            onclick="return confirm('Mulai Ujian?')">Mulai Test</button>
                    @elseIf($ujianSiswa->kecermatan == 1 && $ujianSiswa->kecerdasan == 1)
                        <button class="btn btn-success col-12 mt-4" disabled>Selesai Test</button>
                    @endif

                </form>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
            <div class="card-body">
                <form method="POST" action="{{ action('UjianSiswaController@ujianKepribadian') }}">
                    @csrf
                    <h5 class="text-center">Test Kepribadian</h5>
                    <input type="hidden" name="ujian_id" value="{{ $ujianSiswa->ujian_id }}">
                    <input type="hidden" name="ujian_siswa_id" value="{{ $ujianSiswa->id }}">
                    {{-- <p class="card-text">Some quick example text to build on the card title and make up the bulk
                of the card's content.</p> --}}
                    @if ($ujianSiswa->kecermatan == 1 && $ujianSiswa->kecerdasan == 1 && $ujianSiswa->kepribadian == 0)
                        <button type="submit" class="btn btn-primary col-12 mt-4"
                            onclick="return confirm('Mulai Ujian?')">Mulai Test</button>
                    @elseif($ujianSiswa->kepribadian == 0)
                        <button class="btn btn-secondary col-12 mt-4" disabled>Test Belum Tersedia</button>
                    @endif
                </form>
            </div>
        </div>
    </div>
</div>
@else
<div class="row justify-content-md-center">
    <div class="col-md-4">

        <div class="card">

            <div class="card-body">
                <h5>Nilai CAT Psikologi</h5>
                <h1 class="border text-center p-3">
                    {{ floor(optional($ujianSiswa->getNilai)->nilai_akhir) }}
                </h1>

                <h4 class="border text-center p-3">
                    @if (floor(optional($ujianSiswa->getNilai)->nilai_akhir) >= 61)
                        Memenuhi Syarat
                    @else
                        Tidak Memenuhi Syarat
                    @endif
                </h4>
                <a href="/" class="btn btn-primary btn-sm col-12">Kembali Ke Beranda</a>
            </div>
        </div>
    </div>
</div>
@endif
