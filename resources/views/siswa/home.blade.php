@extends('layouts.app-siswa')
@section('title', 'Home')
@section('css')
    <link href="{{ asset('vendors/datetimepicker/jquery.datetimepicker.min.css') }}" rel="stylesheet">
    <style>
        .bg-white {
            background-color: white;
        }

    </style>
@endsection
@section('js')
    <script src="{{ asset('vendors/datetimepicker/jquery.datetimepicker.full.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('.datetime').datetimepicker({
                timepicker: false,
                format: 'Y/m/d',
            });

            $(document).on('change', '#programAkademik', function() {
                $.ajax({
                    url: "{{ url()->full() }}",
                    type: 'GET',
                    data: {
                        program_akademik_id: $(this).val(),
                    },
                    contentType: 'application/json; charset=utf-8',
                    success: function(response) {
                        $("#kelas").empty();
                        $.each(response, function(key, value) {
                            $("#kelas").append('<option value=' + key + '>' + value +
                                '</option>');
                        });
                    },
                    error: function() {
                        alert("error");
                    }
                });
            });

        })
    </script>
@endsection
@section('content')

    @if (empty(auth()->user()->tanggal_lahir))
        <h5>Silahkan Lengkapi Profile Anda Terlebih Tahulu</h5>
        @include('siswa.profile.form')
    @elseif (auth()->user()->is_active == 'N')
        <div class="alert alert-warning alert-dismissible">
            <h5><i class="fas fa-bullhorn"></i> Pemberitahuan !</h5>

        </div>
        <div class="alert alert-primary alert-dismissible">
            <h3>Hallo {{ auth()->user()->name }}</h3>
            Silahkan menghubungi admin untuk mengaktifkan akun anda.
        </div>
    @else
        @include('siswa.profile.detail')
    @endif

@endsection
