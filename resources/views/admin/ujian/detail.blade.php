@extends('layouts.app-admin')
@section('title', 'TEST PSIKOLOGI')
@section('css')
    <link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .text-inline {
            display: -webkit-box;
        }

    </style>
@endsection
@section('js')
    <script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $(document).on('click', '.hapus-soal', function() {
                if(confirm("Hapus Soal ini ?")) {
                    let ujian_id = $(this).data('ujian_id');
                    let soal_id = $(this).data('soal_id');
                    let kategori = $(this).data('kategori');
                    console.log(kategori);
                    hapusSoal(ujian_id,soal_id,kategori);
                }
                return false;
            })

        });

        $('.table').DataTable();

        function hapusSoal(id_ujian, id_soal, kategori){
            $.ajax({
                type: 'POST',
                url: "{{ action('UjianController@hapusSoal') }}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "ujian_id": id_ujian,
                    "soal_id": id_soal,
                    "kategori": kategori,
                },
                success: function(data) {
                    if (data.code == '200') {
                        Swal.fire(
                            'Berhasil!',
                            'Soal Berhasil Ditambah.',
                            'success'
                        );
                        setTimeout(function() {
                            location.reload();
                        }, 1500);
                    }else{
                        Swal.fire(
                            'Gagal!',
                            data,
                            'error'
                        );
                    }
                }
            });
        }
    </script>
@endsection
@section('button-title')
    <a class="btn btn-sm btn-secondary ml-2 float-right" href="{{ action('UjianController@index') }}" data-toggle="tooltip"
        data-placement="top" title="Kembali">Kembali</a>
@endsection
@section('content')
    <div class="card card-accent-primary border-primary shadow-sm table-responsive">
        <div class="card-header">

            <div class="row">
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-md-8">
                            <input id="waktu_selesai" type="text" class="form-control"
                                value="{{ $pengaturan_ujian->judul }}" autocomplete="off" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Token</label>
                        <div class="col-md-8">
                            <input id="waktu_selesai" type="text" class="form-control"
                                value="{{ $pengaturan_ujian->token }}" autocomplete="off" readonly>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                        href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                        aria-selected="true">Kecerdasan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                        href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                        aria-selected="false">Kecermatan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                        href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages"
                        aria-selected="false">Kepribadian Satu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                        href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings"
                        aria-selected="false">Kepribadian Dua</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade active show" id="custom-tabs-four-home" role="tabpanel"
                aria-labelledby="custom-tabs-four-home-tab">
                <div class="row mb-2">
                    <div class="col-12">
                        @if($pengaturan_ujian->getSoalKecerdasan->count() <= 100)
                        <a class="btn btn-sm btn-warning ml-2 float-right" href="{{ action('UjianController@tambahSoal', ['kecerdasan',$pengaturan_ujian->id]) }}"
                            data-toggle="tooltip" data-placement="top" title="Kembali">Tambah Soal Kecerdasan</a>
                            @endif
                    </div>
                </div>
                <table class="table table-bordered display nowrap table-sm" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">soal</th>
                                <th scope="col">jawaban</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaturan_ujian->getSoalKecerdasan as $soal)
                                <tr>
                                    <th>{{ $loop->index + 1 }}</th>
                                    <td>{!! $soal->pertanyaan !!}</td>
                                    <td class="text-inline">{{ $soal->getJawaban->pilihan }}. {!! $soal->getJawaban->jawaban !!}
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger hapus-soal" data-ujian_id="{{ $soal->pivot->ujian_id }}" data-soal_id="{{ $soal->pivot->kecerdasan_id }}" data-kategori="kecerdasan">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                    aria-labelledby="custom-tabs-four-profile-tab">
                    @if($pengaturan_ujian->getSoalKecermatan->count() <= 10)
                    <div class="row mb-2">
                        <div class="col-12">
                            <a class="btn btn-sm btn-warning ml-2 float-right" href="{{ action('UjianController@tambahSoal', ['kecermatan',$pengaturan_ujian->id]) }}"
                                data-toggle="tooltip" data-placement="top" title="Kembali">Tambah Soal Kecermatan</a>
                        </div>
                    </div>
                    @endif
                    <table class="table table-bordered display nowrap table-sm" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">soal A</th>
                                <th scope="col">soal B</th>
                                <th scope="col">soal C</th>
                                <th scope="col">soal D</th>
                                <th scope="col">soal E</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaturan_ujian->getSoalKecermatan as $soal)
                                <tr>
                                    <th>{{ $loop->index + 1 }}</th>
                                    <td>{{ html_entity_decode($soal->soal_a) }}</td>
                                    <td>{{ html_entity_decode($soal->soal_b) }}</td>
                                    <td>{{ html_entity_decode($soal->soal_c) }}</td>
                                    <td>{{ html_entity_decode($soal->soal_d) }}</td>
                                    <td>{{ html_entity_decode($soal->soal_e) }}</td>
                                    <td class="text-center">
                                          <a href="javascript:void(0)" class="btn btn-xs btn-danger hapus-soal" data-ujian_id="{{ $soal->pivot->ujian_id }}" data-soal_id="{{ $soal->pivot->kecermatan_id }}" data-kategori="kecermatan">Hapus</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                    aria-labelledby="custom-tabs-four-messages-tab">
                    @if($pengaturan_ujian->getSoalKepribadianSatu->count() <= 50)
                    <div class="row mb-2">
                        <div class="col-12">
                            <a class="btn btn-sm btn-warning ml-2 float-right" href="{{ action('UjianController@tambahSoal', ['kepribadian1',$pengaturan_ujian->id]) }}"
                                data-toggle="tooltip" data-placement="top" title="Kembali">Tambah Soal kepribadian 1</a>
                        </div>
                    </div>
                    @endif
                    <table class="table table-bordered display nowrap table-sm" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">soal</th>
                                <th scope="col">jawaban</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaturan_ujian->getSoalKepribadianSatu as $soal)
                                <tr>
                                    <th>{{ $loop->index + 1 }}</th>
                                    <td>{!! $soal->pertanyaan !!}</td>
                                    <td class="text-inline">{{ $soal->getJawaban->pilihan }}. {!! $soal->getJawaban->jawaban !!}
                                    </td>
                                    <td class="text-center">
                                        <a href="javascript:void(0)" class="btn btn-xs btn-danger hapus-soal" data-ujian_id="{{ $soal->pivot->ujian_id }}" data-soal_id="{{ $soal->pivot->kepribadian_id }}" data-kategori="kepribadian_satu">Hapus</a>
                                  </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                    aria-labelledby="custom-tabs-four-settings-tab">
                    <div class="row mb-2">
                        <div class="col-12">
                            <a class="btn btn-sm btn-warning ml-2 float-right" href="{{ action('UjianController@tambahSoal', ['kepribadian2',$pengaturan_ujian->id]) }}"
                                data-toggle="tooltip" data-placement="top" title="Kembali">Tambah Soal kepribadian 2</a>
                        </div>
                    </div>
                    <table class="table table-bordered display nowrap table-sm" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">No</th>
                                <th scope="col">soal</th>
                                <th scope="col">jawaban</th>
                                <th scope="col">action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pengaturan_ujian->getSoalKepribadianDua as $soal)
                            <tr>
                                <th>{{ $loop->index + 1 }}</th>
                                <td>{!! $soal->pertanyaan !!}</td>
                                <td class="text-inline">{{ $soal->getJawaban->pilihan }}. {!! $soal->getJawaban->jawaban !!}
                                </td>
                                <td class="text-center">
                                    <a href="javascript:void(0)" class="btn btn-xs btn-danger hapus-soal" data-ujian_id="{{ $soal->pivot->ujian_id }}" data-soal_id="{{ $soal->pivot->kepribadian_id }}" data-kategori="kepribadian_dua">Hapus</a>
                              </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /.card -->
    </div>

@endsection
