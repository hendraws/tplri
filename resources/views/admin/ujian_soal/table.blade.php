<div class="table-responsive">
    <table class="table" style="font-size: 13px;">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col">No.</th>
                <th scope="col">Soal</th>
                <th scope="col">Jawaban</th>
                <th scope="col">aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td class="text-center">{{ $loop->index + 1 }}</td>
                    <td class="">{!! $item->pertanyaan !!}</td>
                    <td class="">
                        @if (!empty($item->pilihan))
                            {{ $item->pilihan }}.{!! $item->jawaban !!}
                        @else
                            Benar Semua
                        @endif
                    </td>
                    <td class="text-center">
                        <a class="btn btn-xs btn-danger hapus" href="Javascript:void(0)" data-target="ModalForm"
                            data-url="{{ action('UjianSoalController@destroy', $item) }}" data-toggle="tooltip"
                            data-placement="top" title="hapus" data-id="{{ $item->id }}">Hapus</a>
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
<div class="card-body p-2 border-top">
    <div class="row justify-content-between align-items-center">
        <div class="col-auto ml-auto">
            {!! $data->appends(request()->except('_token'))->links() !!}
        </div>
    </div>
</div>

<script>
    $('p img').attr('class', 'img-fluid img-thumbnail mh').removeAttr('style');
</script>
