@extends('layouts.app-admin')
@section('title', 'Dashboard')
@section('button-title')
@endsection
@section('content')
    @php
        $jumlahKecerdasan = [];
        $jumlahKecermatan = [];
    @endphp
    <div class="row">
        <div class="col-3">
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
        <div class="col-3">
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

    </div>
@endsection
