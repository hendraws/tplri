@extends('errors::minimal')

@section('title', __('Not Found'))
{{-- @section('code', '404')
@section('message', __('Not Found')) --}}
@section('teks')
<img class="image-404" src="{{ asset('images/404/404.svg') }} " width="300px">
@endsection
