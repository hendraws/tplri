<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>TOKEN</title>
    <link rel="stylesheet" href="{{ asset('vendors/bootstrap-4/css/bootstrap.min.css') }}">
</head>
<body>
    <table class="table">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">TOKEN</th>
            <th scope="col">Judul</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($data as $item )
            <tr>
                <th scope="row">{{ $loop->index + 1 }}</th>
                <td>{{ $item->judul }}</td>
                <td>{{ $item->token }}</td>
                <td>
                    <a class="btn btn-xs btn-info"
                    href="{{ action('UjianController@generate', $item->id) }}" data-toggle="tooltip"
                    data-placement="top" title="Generate" data-id="{{ $item->id }}">Generate</a>
                </td>
            </tr>
            @endforeach
        </tbody>
      </table>
</body>
</html>
