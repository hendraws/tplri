@extends('layouts.app-admin')
@section('title', 'Dashboard')
@section('button-title')
@endsection
@section('content')
    @php
    $jumlahKecerdasan = [];
    $jumlahKecermatan = [];
    $jumlahKepribadian1 = [];
    @endphp
    <div class="row">
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $dataUser->count() }}</h3>
                    <p>Total User</p>
                </div>
                <div class="icon">
                    <i class="fa fa-users" aria-hidden="true"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
                <div class="inner">
                    <h3>{{ $dataUser->where('is_active', 'Y')->count() }}</h3>
                    <p>User Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-check"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-4 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $dataUser->where('is_active', 'N')->count() }}</h3>
                    <p>User Non Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-times"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        {{-- <div class="col-md-3">
            <h4>Kecerdasan</h4>
            <div class="card">
                <div class="card-body p-1">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr class="bg-dark">
                                <th scope="col">Kategori</th>
                                <th scope="col">Jumlah Soal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jumlahSoalKecerdasan as $key => $value)
                                <tr>
                                    <th scope="row">{{ $key }}</th>
                                    <td class="text-right">{{ $value->count() }}</td>
                                </tr>
                                @php
                                    $jumlahKecerdasan[] = $value->count();
                                @endphp
                            @endforeach
                            <tr>
                                <th scope="row">Jumlah Soal Kecerdasan</th>
                                <th class="text-right">{{ array_sum($jumlahKecerdasan) }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <h4>Kecermatan</h4>
            <div class="card">
                <div class="card-body p-1">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr class="bg-dark">
                                <th scope="col">Kategori</th>
                                <th scope="col">Jumlah Soal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jumlahSoalKecermatan as $key => $value)
                                <tr>
                                    <th scope="row">{{ $key }}</th>
                                    <td class="text-right">{{ $value->count() }}</td>
                                </tr>
                                @php
                                    $jumlahKecermatan[] = $value->count();
                                @endphp
                            @endforeach
                            <tr>
                                <th scope="row">Jumlah Soal Kecermatan</th>
                                <th class="text-right">{{ array_sum($jumlahKecermatan) }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <h4>Kepribadian Sesi 1</h4>
            <div class="card">
                <div class="card-body p-1">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr class="bg-dark">
                                <th scope="col">Kategori</th>
                                <th scope="col">Jumlah Soal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jumlahSoalKepribadianSesi1 as $key => $value)
                                <tr>
                                    <th scope="row">{{ $key }}</th>
                                    <td class="text-right">{{ $value->count() }}</td>
                                </tr>
                                @php
                                    $jumlahKepribadian1[] = $value->count();
                                @endphp
                            @endforeach
                            <tr>
                                <th scope="row">Jumlah Soal Kepribadian Sesi 1</th>
                                <th class="text-right">{{ array_sum($jumlahKepribadian1) }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <h4>Kepribadian Sesi 2</h4>
            <div class="card">
                <div class="card-body p-1">
                    <table class="table table-bordered table-sm">
                        <thead>
                            <tr class="bg-dark">
                                <th scope="col">Kategori</th>
                                <th scope="col">Jumlah Soal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Jumlah Soal Kepribadian Sesi 2</th>
                                <th class="text-right">{{ $soalKepribadianSesi2->count() }}</th>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}

        {{-- <div class="col-md-6">
            <h4>Top 10 Nilai CAT AKADEMIK AKPOL</h4>
            <div class="card">
                <div class="card-body p-1">
                    <div class="">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr class="bg-dark text-center">
                                    <th scope="col" class="align-middle" width="30%">Nama</th>
                                    <th scope="col" class="align-middle" width="10%">MTK</th>
                                    <th scope="col" class="align-middle" width="10%">WK</th>
                                    <th scope="col" class="align-middle" width="10%">PU</th>
                                    <th scope="col" class="align-middle" width="10%">B. Ind</th>
                                    <th scope="col" class="align-middle" width="10%">Nilai Akhir</th>
                                    <th scope="col" class="align-middle" width="30%">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai as $key => $value)
                                    <tr>
                                        <th scope="row">{{ optional(optional($value->getUjianSiswa)->getSiswa)->name }}
                                        </th>
                                        <td class="text-right">0</td>
                                        <td class="text-right">0</td>
                                        <td class="text-right">0</td>
                                        <td class="text-right">0</td>
                                        <td class="text-right">0</td>
                                        <td class="text-center">{{ optional($value->getUjianSiswa)->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h4>Top 10 Nilai CAT AKADEMIK BINTARA</h4>
            <div class="card">
                <div class="card-body p-1">
                    <div class="">
                        <table class="table table-bordered table-sm">
                            <thead>
                                <tr class="bg-dark text-center">
                                    <th scope="col" class="align-middle" width="30%">Nama</th>
                                    <th scope="col" class="align-middle" width="10%">MTK</th>
                                    <th scope="col" class="align-middle" width="10%">WK</th>
                                    <th scope="col" class="align-middle" width="10%">PU</th>
                                    <th scope="col" class="align-middle" width="10%">B. Ing</th>
                                    <th scope="col" class="align-middle" width="10%">Nilai Akhir</th>
                                    <th scope="col" class="align-middle" width="30%">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($nilai as $key => $value)
                                    <tr>
                                        <th scope="row">{{ optional(optional($value->getUjianSiswa)->getSiswa)->name }}
                                        </th>
                                        <td class="text-right">0</td>
                                        <td class="text-right">0</td>
                                        <td class="text-right">0</td>
                                        <td class="text-right">0</td>
                                        <td class="text-right">0</td>
                                        <td class="text-center">{{ optional($value->getUjianSiswa)->created_at }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> --}}

    </div>
@endsection
