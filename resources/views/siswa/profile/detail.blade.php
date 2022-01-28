<div class="row">

    <div class="col-12 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-body">
                <div class="row">
                    <div class="col-7">
                        <div class="row">
                            <div class="col-4">
                                Nama
                            </div>
                            <div class="col-8">
                                : {{ ucfirst($user->name) }}
                            </div>
                            <div class="col-4">
                                Tempat Tanggal Lahir
                            </div>
                            <div class="col-8">
                                : {{ ucfirst($user->tempat_lahir) }}, {{ date('d M Y', strtotime($user->tanggal_lahir))  }}
                            </div>
                            <div class="col-4">
                                Alamat
                            </div>
                            <div class="col-8">
                                : {{ ucfirst($user->alamat) }}
                            </div>
                            <div class="col-4">
                                Telepon
                            </div>
                            <div class="col-8">
                                : {{ $user->telepon }}
                            </div>
                            <div class="col-4">
                                Program Akademik
                            </div>
                            <div class="col-8">
                                : {{ optional($user->getProgramAkademik)->nama_program }}
                            </div>
                            <div class="col-4">
                                Kelas
                            </div>
                            <div class="col-8">
                                : {{ optional($user->getKelas)->nama_kelas }}
                            </div>

                        </div>
                        </p>
                        <div class="row">
                            <div class="col-12 text-center" style="font-size : 1.25rem">
                                <p class="mb-0 "> <em> " {{ $user->motto }} " </em></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-5 text-center">
                        <img src="{{ Storage::url($user->foto) }}" alt="user-avatar"
                            class=" img-thumbnail" style="max-width: 250px;
                            max-height: 200px;">
                    </div>
                </div>
            </div>
            <div class="card-footer">
                </a>
                <a href="{{ action('UjianSiswaController@ruangUjian') }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-chalkboard-teacher mr-2"></i></i> Ujian
                </a>
                <a href="{{ url("under-contruction") }}" class="btn btn-sm btn-primary">
                    <i class="far fa-file-alt mr-2"></i> Riwayat Ujian
                </a>
            </div>
        </div>
    </div>
</div>
