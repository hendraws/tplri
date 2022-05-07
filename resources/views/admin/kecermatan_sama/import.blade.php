<form action="{{ action('KecermatanSamaController@saveImport') }}" enctype='multipart/form-data' method='post'>
    @csrf
    <input type="file" name="import_file">
    <button type="submit" >submit</button>
</form>
