@extends('layouts.master')

@section('title',  __(\App\Models\Category::NAME))

@section('style')
    <link rel="stylesheet" href="{{ asset('assets/js/croppie/croppie.min.css') }}">
@endsection

@section('breadcrumb-title',  __(\App\Models\Category::NAME))

@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('category.index') }}">{{ __(\App\Models\Category::NAME) }}</a></li>
    <li class="breadcrumb-item active">{{ __('Crear') }}</li>
@endsection

@section('body')

    <!-- Container-fluid starts-->
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-sm-12 col-xl-4">
                <div class="card">
                    <form action="{{ route('category.store') }}" enctype="multipart/form-data" method="post" class="theme-form" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('Nombre') }}</label>
                                <input required type="text" name="name" class="form-control">
                                @error('name')
                                <p class="text-danger text-sm"> {{ $errors->first('name') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Imagen') }}</label>
                                <input type="file"  id="upload_image"  class="form-control">
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
            @hasrole(\App\User::CUSTOMER_ROLE)
                <div class="col-sm-12 col-xl-6">
                    <search-category></search-category>
                </div>
            @endhasrole

        </div>
    </div>
    <!-- Container-fluid Ends-->
    @include('modals.image_modal')
@endsection

@section('script')
    <script src="{{ asset('assets/js/croppie/croppie.min.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ mix('js/image.js') }}"></script>
@endsection
