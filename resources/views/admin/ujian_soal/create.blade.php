@extends('layouts.app-admin')
@section('title', 'Pengaturan Soal Ujian CAT')
@section('css')
    <style>
        .mh {
            height: 200px;
        }

        td p {
            display: inline;
        }

        .check {
            transform: scale(2);
        }

    </style>
@endsection
@section('js')
    <script>
        $('p img').attr('class', 'img-fluid img-thumbnail mh').removeAttr('style');
    </script>
@endsection
@section('button-title')
<a class="btn btn-sm btn-secondary ml-2 float-right" href="{{ action('UjianController@index') }}"  >Kembali </a>
@endsection
@section('content')

    <div class="card card-accent-primary border-primary shadow-sm table-responsive">
        <form method="POST" action="{{ action('UjianSoalController@store') }}">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" width="10%" class="text-center"></th>
                                    <th scope="col" width="10%" class="text-center">No</th>
                                    <th scope="col" width="50%">Soal</th>
                                    <th scope="col">Jawaban</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($data as $item)
                                    <tr>
                                        <th class="text-center align-middle">
                                            <input type="checkbox" class="form-check-input check m-0" name="soal_id[]"
                                                value="{{ $item->id }}">
                                        </th>
                                        <td class="text-center align-middle">
                                            {{ $loop->index + 1 }}
                                        </td>
                                        {{-- {{ dd($item->getJawabanBenar) }} --}}
                                        <td class="align-middle">{!! $item->pertanyaan !!}</td>
                                        <td class="align-middle">
                                            @if (!empty($item->pilihan))
                                                {{ $item->pilihan }}.{!! $item->jawaban !!}
                                            @else
                                                Benar Semua
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="text-center text-bold bg-secondary" colspan="9">
                                            <h5>TIDAK ADA DATA</h5>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <input type="hidden" name="ujian_mapel_id" value="{{ $ujianMapel->id }}">
                    <input type="hidden" name="ujian_id" value="{{ $ujianMapel->ujian_id }}">
                    <div class="col-12">
                        <div class="d-flex">
                            <div class="ml-auto">
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                    @if ($data->count() > 0)
                        <div class="col-12">

                            <div class="modal-footer">
                                <button class="btn btn-brand btn-square btn-primary col">Simpan</button>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>

@endsection
