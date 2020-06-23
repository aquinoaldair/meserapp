@extends('layouts.master')

@section('title',  __(\App\Models\Category::NAME))


@section('style')
    <link rel="stylesheet" href="{{ asset('assets/js/croppie/croppie.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
@endsection

@section('breadcrumb-title',  __(\App\Models\Category::NAME))

@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">{{ __(\App\Models\Category::NAME) }}</a></li>
    <li class="breadcrumb-item active">{{ __('Editar') }}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-4">
                <div class="card">
                    <form action="{{ route('category.update', $category) }}" enctype="multipart/form-data" method="post" class="theme-form" autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('Nombre') }}</label>
                                <input required type="text" name="name" class="form-control" value="{{ $category->name }}">
                                @error('name')
                                <p class="text-danger text-sm"> {{ $errors->first('name') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Imagen') }}</label>
                                <input type="file"  id="upload_image"  class="form-control">
                                <small>Si selecciona una foto, se remplezará la anterior</small>
                            </div>

                            <input type="hidden" id="file_device" name="file_device">
                            <img src="" alt="" id="result">
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp; {{ __("Guardar") }}</button>
                            <a class="btn btn-secondary text-white" href="{{ route('product.index') }}" ><i class="fa fa-mail-reply"></i>&nbsp;{{ __("Cancelar") }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
    @include('modals.image_modal')
@endsection


@section('script')
    <script src="{{ asset('assets/js/croppie/croppie.min.js') }}"></script>
    <script src="{{ mix('js/image.js') }}"></script>
@endsection
