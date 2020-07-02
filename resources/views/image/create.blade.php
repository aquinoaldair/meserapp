@extends('layouts.master')

@section('title',  __(\App\Models\Image::NAME))



@section('style')
    <link rel="stylesheet" href="{{ asset('assets/js/croppie/croppie.min.css') }}">
@endsection

@section('breadcrumb-title',  __(\App\Models\Image::NAME))

@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('image.index') }}">{{ __(\App\Models\Image::NAME) }}</a></li>
    <li class="breadcrumb-item active">{{ __('Crear') }}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-sm-12 col-xl-4">
                <div class="card">
                    <form action="{{ route('image.store') }}" enctype="multipart/form-data" method="post" class="theme-form" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <input type="hidden" id="file_device" name="file_device">
                                <image-crop></image-crop>
                            </div>

                            <div class="form-group">
                                <label>{{ __('Palabras Claves') }}</label>
                                <input required type="text" name="keywords" class="form-control">
                                <small>{{ __("separar por commas") }}</small>
                                @error('name')
                                <p class="text-danger text-sm"> {{ $errors->first('keywords') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp; {{ __("Guardar") }}</button>
                            <a class="btn btn-secondary text-white" href="{{ route('image.index') }}" ><i class="fa fa-mail-reply"></i>&nbsp;{{ __("Cancelar") }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
