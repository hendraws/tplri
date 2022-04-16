@extends('layouts.app-admin')
@section('title', 'Tambah Soal TWK')
@section('css')
    <link href="{{ asset('vendors/DataTables/datatables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <style>
        .cke_dialog_ui_input_file {
            width: 100%;
            height: 900px !important;
        }

    </style>
@endsection
@section('js')
    <script src="{{ asset('vendors/DataTables/datatables.min.js') }}"></script>
    <script src="{{ asset('vendors/ckeditor/build/ckeditor.js') }}"></script>
    <script src="{{ asset('plugins/select2/js/select2.full.min.js') }}"></script>
    {{-- <script src="//cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script> --}}
    {{-- <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script> --}}

    {{-- <script src="{{ asset('js/summernote-cleaner.js') }}"></script> --}}
    <script>
        class MyUploadAdapter {
            constructor(loader) {
                // The file loader instance to use during the upload. It sounds scary but do not
                // worry — the loader will be passed into the adapter later on in this guide.
                this.loader = loader;
            }

            // Starts the upload process.
            upload() {
                return this.loader.file
                    .then(file => new Promise((resolve, reject) => {
                        this._initRequest();
                        this._initListeners(resolve, reject, file);
                        this._sendRequest(file);
                    }));
            }

            // Aborts the upload process.
            abort() {
                if (this.xhr) {
                    this.xhr.abort();
                }
            }

            // Initializes the XMLHttpRequest object using the URL passed to the constructor.
            _initRequest() {
                const xhr = this.xhr = new XMLHttpRequest();

                // Note that your request may look different. It is up to you and your editor
                // integration to choose the right communication channel. This example uses
                // a POST request with JSON as a data structure but your configuration
                // could be different.
                xhr.open('POST', '{{ action('SoalCatSkdController@upload') }}', true);
                xhr.setRequestHeader('x-csrf-token', '{{ csrf_token() }}');
                xhr.responseType = 'json';
            }

            // Initializes XMLHttpRequest listeners.
            _initListeners(resolve, reject, file) {
                const xhr = this.xhr;
                const loader = this.loader;
                const genericErrorText = `Couldn't upload file: ${ file.name }.`;

                xhr.addEventListener('error', () => reject(genericErrorText));
                xhr.addEventListener('abort', () => reject());
                xhr.addEventListener('load', () => {
                    const response = xhr.response;

                    // This example assumes the XHR server's "response" object will come with
                    // an "error" which has its own "message" that can be passed to reject()
                    // in the upload promise.
                    //
                    // Your integration may handle upload errors in a different way so make sure
                    // it is done properly. The reject() function must be called when the upload fails.
                    if (!response || response.error) {
                        return reject(response && response.error ? response.error.message : genericErrorText);
                    }

                    // If the upload is successful, resolve the upload promise with an object containing
                    // at least the "default" URL, pointing to the image on the server.
                    // This URL will be used to display the image in the content. Learn more in the
                    // UploadAdapter#upload documentation.
                    resolve({
                        default: response.url
                    });
                });

                // Upload progress when it is supported. The file loader has the #uploadTotal and #uploaded
                // properties which are used e.g. to display the upload progress bar in the editor
                // user interface.
                if (xhr.upload) {
                    xhr.upload.addEventListener('progress', evt => {
                        if (evt.lengthComputable) {
                            loader.uploadTotal = evt.total;
                            loader.uploaded = evt.loaded;
                        }
                    });
                }
            }

            // Prepares the data and sends the request.
            _sendRequest(file) {
                // Prepare the form data.
                const data = new FormData();

                data.append('upload', file);

                // Important note: This is the right place to implement security mechanisms
                // like authentication and CSRF protection. For instance, you can use
                // XMLHttpRequest.setRequestHeader() to set the request headers containing
                // the CSRF token generated earlier by your application.

                // Send the request.
                this.xhr.send(data);
                // ...
            }
        }

        function SimpleUploadAdapterPlugin(editor) {
            editor.plugins.get('FileRepository').createUploadAdapter = (loader) => {
                // Configure the URL to the upload script in your back-end here!
                return new MyUploadAdapter(loader);
            };
        }



        ClassicEditor
            .create(document.querySelector('#pertanyaan'), {
                extraPlugins: [SimpleUploadAdapterPlugin],

                // ...
            })
            .catch(error => {
                console.error(error);
            });

            ClassicEditor
            .create(document.querySelector('#textarea-a-1'), {
                extraPlugins: [SimpleUploadAdapterPlugin],

                // ...
            })
            .catch(error => {
                console.error(error);
            });

            ClassicEditor
            .create(document.querySelector('#textarea-b-1'), {
                extraPlugins: [SimpleUploadAdapterPlugin],

                // ...
            })
            .catch(error => {
                console.error(error);
            });
            ClassicEditor
            .create(document.querySelector('#textarea-c-1'), {
                extraPlugins: [SimpleUploadAdapterPlugin],

                // ...
            })
            .catch(error => {
                console.error(error);
            });
            ClassicEditor
            .create(document.querySelector('#textarea-d-1'), {
                extraPlugins: [SimpleUploadAdapterPlugin],

                // ...
            })
            .catch(error => {
                console.error(error);
            });
            ClassicEditor
            .create(document.querySelector('#textarea-e-1'), {
                extraPlugins: [SimpleUploadAdapterPlugin],

                // ...
            })
            .catch(error => {
                console.error(error);
            });
    </script>

@endsection
@section('button-title')
@endsection
@section('content')
    <div class="card card-accent-primary border-primary shadow-sm table-responsive">
        <form method="POST" action="{{ action('SoalCatSkdController@storeTwk') }}" enctype='multipart/form-data'>
            @csrf
            <div class="card-body">
                <div class="form-group row">
                    <label for="nama_program" class="col-sm-2 col-form-label">Pertanyaan</label>
                    <div class="col-md-12">
                        <textarea class="form-control text-editor" id="pertanyaan" rows="1" name="pertanyaan"></textarea>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6 border">
                        <div class="form-group">
                            <label class="col-form-label">Pilihan A</label>
                            <textarea class="form-control text-editor" id="textarea-a-1" rows="1" name="jawaban[a]"></textarea>
                        </div>
                    </div>
                    <div class="col-6 border">
                        <div class="form-group">
                            <label class="col-form-label">Pilihan B</label>
                            <textarea class="form-control text-editor" id="textarea-b-1" rows="1" name="jawaban[b]"></textarea>

                        </div>
                    </div>
                    <div class="col-6 border">
                        <div class="form-group">
                            <label class="col-form-label">Pilihan C</label>
                            <textarea class="form-control text-editor" id="textarea-c-1" rows="1" name="jawaban[c]"></textarea>

                        </div>
                    </div>
                    <div class="col-6 border">
                        <div class="form-group">
                            <label class="col-form-label">Pilihan D</label>
                            <textarea class="form-control text-editor" id="textarea-d-1" rows="1" name="jawaban[d]"></textarea>

                        </div>
                    </div>
                    <div class="col-6 border">
                        <div class="form-group">
                            <label class="col-form-label">Pilihan E</label>
                            <textarea class="form-control text-editor" id="textarea-e-1" rows="1" name="jawaban[e]"></textarea>

                        </div>
                    </div>
                    <div class="col-6 align-self-center text-center h5 ">
                        <label class="col-form-label">Jawaban Benar</label>
                        <div class="col-md-12">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="A" required value="a">
                                <label class="form-check-label" for="A">A</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="B" required value="b">
                                <label class="form-check-label" for="B">B</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="C" required value="c">
                                <label class="form-check-label" for="C">C</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="D" required value="d">
                                <label class="form-check-label" for="D">D</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jawaban_benar" id="E" required value="e">
                                <label class="form-check-label" for="E">E</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-brand btn-square btn-primary col">Simpan</button>
                </div>
            </div>
        </form>
    </div>

@endsection
