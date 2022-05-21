@extends('layouts.app-admin')
@section('title', 'Pembuatan Ujian Psikologi POLRI')
@section('css')
    <link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
@endsection
@section('js')
    <script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {

        })
    </script>
@endsection
@section('button-title')
    <a class="btn btn-sm btn-secondary ml-2 float-right" href="{{ action('UjianController@index') }}">Kembali </a>
@endsection
@section('content')
    <div class="card card-accent-primary border-primary shadow-sm table-responsive">

    </div>
    <div class="card card-primary card-outline card-outline-tabs">
        <div class="card-header p-0 border-bottom-0">
            <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                        href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                        aria-selected="true">CAT PSIKOLOGI</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill"
                        href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile"
                        aria-selected="false">CAT AKADEMIK</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-settings-tab" data-toggle="pill"
                        href="#custom-tabs-four-settings" role="tab" aria-controls="custom-tabs-four-settings"
                        aria-selected="false">CAT KECERMATAN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill"
                        href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages"
                        aria-selected="false">CAT KECERMATAN SAMA</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-four-kepribadian-tab" data-toggle="pill"
                        href="#custom-tabs-four-kepribadian" role="tab" aria-controls="custom-tabs-four-kepribadian"
                        aria-selected="false">CAT KEPRIBADIAN</a>
                </li>

            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content" id="custom-tabs-four-tabContent">
                <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                    aria-labelledby="custom-tabs-four-home-tab">
                    @includeIf('admin.ujian.kategori.cat_psikologi')
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-profile" role="tabpanel"
                    aria-labelledby="custom-tabs-four-profile-tab">
                    @includeIf('admin.ujian.kategori.cat_akademik')
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-settings" role="tabpanel"
                aria-labelledby="custom-tabs-four-settings-tab">
                @includeIf('admin.ujian.kategori.cat_kecermatan')
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-messages" role="tabpanel"
                    aria-labelledby="custom-tabs-four-messages-tab">
                    @includeIf('admin.ujian.kategori.cat_kecermatan_sama')
                </div>
                <div class="tab-pane fade" id="custom-tabs-four-kepribadian" role="tabpanel"
                    aria-labelledby="custom-tabs-four-kepribadian-tab">
                    @includeIf('admin.ujian.kategori.cat_kepribadian')
                </div>

            </div>
        </div>
        <!-- /.card -->
    </div>

@endsection
