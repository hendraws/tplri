
<div class="table-responsive">
    <table class="table mb-0" style="font-size: 13px;">
        <thead class="thead-dark">
            <tr class="text-center">
                <th scope="col" colspan="6">SOAL & Pilihan Jawaban</th>
                <th scope="col">aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data as $item)
                <tr>
                    <td rowspan="2">{{ $loop->index + 1 }}</td>
                    <td colspan="5">{!! $item->pertanyaan !!}</td>
                    <td rowspan="2" width="10%" class="align-middle">
                        <a class="btn btn-xs btn-warning  m-1" href="{{ action('SoalController@edit', $item) }}"  data-toggle="tooltip" data-placement="top" title="Edit" data-id="{{ $item->id }}" style="width: 100%">Edit</a>
                    <a href="Javascript:void(0)" class="btn btn-xs btn-danger hapus m-1" data-url="{{ action('SoalController@destroy', $item) }}" style="width: 100%">Hapus</a>
                    </td>
                </tr>
                <tr>
                    @foreach ($item->getJawaban as $v )
                        <td class= "{{ $v->benar == 'Y' ? 'text-dark bg-success ' : '' }}" width="20%"><span>{{ $v->pilihan }}. {!! $v->jawaban !!}</span></td>
                    @endforeach
                </tr>
            @empty
                <tr>
                    <td class="text-center text-bold bg-secondary" colspan="7">
                        <h5>TIDAK ADA DATA SOAL</h5>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
<style>
    td p {
        display: inline;
    }
    .mh{
        height: 200px;
    }
</style>
<script>
    $('p img').attr('class', 'img-fluid img-thumbnail mh').removeAttr('style');
</script>

