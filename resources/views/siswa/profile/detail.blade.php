<div class="row">

    <div class="col-12 d-flex align-items-stretch flex-column">
        <div class="card bg-light d-flex flex-fill">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-center">
                <a href="{{ action('UjianSiswaController@ruangUjian') }}" class="btn btn-sm btn-warning col-5">
                    <i class="fas fa-chalkboard-teacher mr-2"></i></i> Ujian
                </a>
                <a href="{{ action('SiswaController@riwayatUjian') }}" class="btn btn-sm btn-primary col-5">
                    <i class="far fa-file-alt mr-2"></i> Riwayat Ujian
                </a>
            </div>
        </div>
    </div>
</div>
