@extends('layouts.master')

@section('title',  __(\App\Models\Product::NAME))
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/photoswipe.css')}}">
@section('style')

@endsection

@section('breadcrumb-title',  __(\App\Models\Product::NAME))

@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">{{ __(\App\Models\Product::NAME) }}</a></li>
    <li class="breadcrumb-item active">{{ __('Crear') }}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-sm-12 col-xl-8">
                <div class="card">
                    <form action="{{ route('product.store') }}" enctype="multipart/form-data" method="post" class="theme-form" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 col-xl-6">
                                    <div class="form-group">
                                        <label>{{ __('Nombre') }}</label>
                                        <input required type="text" name="name" class="form-control" value="{{ old('name') }}">
                                        @error('name')
                                        <p class="text-danger text-sm"> {{ $errors->first('name') }}</p>
                                        @enderror
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <label>{{ __('Administrar Stock') }}</label>
                                            <div class="form-group m-t-15 m-checkbox-inline mb-0 custom-radio-ml">
                                                <div class="radio radio-primary">
                                                    <input id="radioinline1" {{ old('use_stock') == 1 ? "checked" : "" }}  type="radio" name="use_stock" value="1" required>
                                                    <label class="mb-0" for="radioinline1"><span class="digits">{{ __("Si") }}</span></label>
                                                </div>
                                                <div class="radio radio-primary">
                                                    <input id="radioinline2" {{ old('use_stock') == 0 ? "checked" : "" }} type="radio" name="use_stock" value="0" required>
                                                    <label class="mb-0" for="radioinline2"><span class="digits">{{ __("No") }}</span></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ __('Cantidad') }}</label>
                                                <input required type="number" name="stock" class="form-control" value="{{ old('stock') ?? 0.0 }}">
                                                @error('stock')
                                                <p class="text-danger text-sm"> {{ $errors->first('stock') }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ __('Margen') }}</label>
                                                <input required type="text" name="margin" class="form-control" value="{{ old('margin') }}">
                                                @error('margin')
                                                <p class="text-danger text-sm"> {{ $errors->first('margin') }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <label>{{ __('Precio') }}</label>
                                                <input required type="number" name="price" class="form-control" step='0.01' value='0.00' placeholder='0.00'>
                                                @error('price')
                                                <p class="text-danger text-sm"> {{ $errors->first('price') }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                <label>{{ __('Categoria') }}</label>
                                                <select name="category_id" class="form-control">
                                                    @foreach($categories as $category)
                                                        <option {{ old('category_id') == $category->id ? "selected" : "" }} value="{{ $category->id }}">{{ $category->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('category_id')
                                                <p class="text-danger text-sm"> {{ $errors->first('category_id') }}</p>
                                                @enderror
                                            </div>
                                            <div class="col-12 col-md-6">
                                                <label>{{ __('Estacion de preparado') }}</label>
                                                <select name="station_id" class="form-control">
                                                    @foreach($stations as $item)
                                                        <option {{ old('station_id') == $item->id ? "selected" : "" }} value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                                @error('station_id')
                                                <p class="text-danger text-sm"> {{ $errors->first('station_id') }}</p>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>{{ __('Descripción') }}</label>
                                        <input required type="text" name="description" value="{{ old('description') }}" class="form-control">
                                        @error('description')
                                        <p class="text-danger text-sm"> {{ $errors->first('description') }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 col-xl-6">
                                    <div class="form-group">
                                        @error('file_gallery')
                                        <p class="text-danger text-sm"> {{ $errors->first('file_gallery') }}</p>
                                        @enderror
                                        @error('file_device')
                                        <p class="text-danger text-sm"> {{ $errors->first('file_device') }}</p>
                                        @enderror
                                        <label>{{ __('Seleccionar Imagen') }}</label>
                                        <ul class="nav nav-tabs" id="icon-tab" role="tablist">
                                            <li class="nav-item"><a class="nav-link active show" id="icon-home-tab" data-toggle="tab" href="#icon-home" role="tab" aria-controls="icon-home" aria-selected="true" data-original-title="" title="">
                                                    <i class="icofont icofont-ui-folder"></i>{{ __("Dispositivo") }}</a>
                                            </li>
                                            <li class="nav-item"><a class="nav-link" id="profile-icon-tab" data-toggle="tab" href="#profile-icon" role="tab" aria-controls="profile-icon" aria-selected="false" data-original-title="" title="">
                                                    <i class="icofont icofont-ui-image"></i>{{ __("Galeria") }}</a></li>
                                        </ul>
                                        <div class="tab-content p-3" id="icon-tabContent">
                                            <div class="tab-pane fade active show" id="icon-home" role="tabpanel" aria-labelledby="icon-home-tab">
                                                <input type="file" name="file_device" class="form-control">
                                                <input type="hidden" id="file_gallery" name="file_gallery" value="">
                                            </div>
                                            <div class="tab-pane fade" id="profile-icon" role="tabpanel" aria-labelledby="profile-icon-tab">
                                                <search-product></search-product>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
@endsection

@section('script')
    <script src="{{asset('assets/js/isotope.pkgd.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe.min.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe-ui-default.min.js')}}"></script>
    <script src="{{asset('assets/js/photoswipe/photoswipe.js')}}"></script>
    <script src="{{asset('assets/js/chat-menu.js')}}"></script>
    <script src="{{asset('assets/js/masonry-gallery.js')}}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
