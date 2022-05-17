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

        <div class="col-md-4">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $soal->sum('jumlah') }}</h3>
                    <p>Total Soal</p>
                </div>
                <div class="icon">
                    <i class="far fa-file-alt"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <div class="col-md-4">
            <!-- small box -->
            <div class="small-box bg-maroon color-palette">
                <div class="inner">
                    <h3>{{ $soal->where('mapel', 'mtk')->first()->jumlah }}</h3>
                    <p>MTK</p>
                </div>
                <div class="icon">
                    <i class="fas fa-calculator"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4">
            <!-- small box -->
            <div class="small-box bg-lightblue">
                <div class="inner">
                    <h3>{{ $soal->where('mapel', 'pu')->first()->jumlah }}</h3>
                    <p>Pengetahuan Umum</p>
                </div>
                <div class="icon">
                    <i class="fas fa-brain"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
        <div class="col-md-4">
            <!-- small box -->
            <div class="small-box bg-navy color-palette">
                <div class="inner">
                    <h3>{{ $soal->where('mapel', 'wk')->first()->jumlah }}</h3>
                    <p>Wawasan Kebangsaan</p>
                </div>
                <div class="icon">
                    <i class="far fa-flag"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <div class="col-md-4">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>{{ $soal->where('mapel', 'bing')->first()->jumlah }}</h3>
                    <p>Bahasa Inggris</p>
                </div>
                <div class="icon">
                    <i class="fas fa-language"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <div class="col-md-4">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>{{ $soal->where('mapel', 'bind')->first()->jumlah }}</h3>
                    <p>Bahasa Indonesia</p>
                </div>
                <div class="icon">
                    <i class="fas fa-language"></i>
                </div>
                {{-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> --}}
            </div>
        </div>
        <!-- ./col -->
    </div>
    <div class="row">
        {{-- <div class="col-md-4">
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


    </div>
@endsection
