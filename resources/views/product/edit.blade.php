@extends('layouts.master')

@section('title',  __(\App\Models\Product::NAME))

@section('style')
@endsection

@section('breadcrumb-title',  __(\App\Models\Product::NAME))

@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('product.index') }}">{{ __(\App\Models\Product::NAME) }}</a></li>
    <li class="breadcrumb-item active">{{ __('Editar') }}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-4">
                <div class="card">
                    <form action="{{ route('product.update', $product) }}" enctype="multipart/form-data" method="post" class="theme-form" autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('Nombre') }}</label>
                                <input required type="text" name="name" class="form-control" value="{{ $product->name }}">
                                @error('name')
                                <p class="text-danger text-sm"> {{ $errors->first('name') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Categoria') }}</label>
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option {{ $category->id == $product->category->id ? "selected" : '' }} value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('name')
                                <p class="text-danger text-sm"> {{ $errors->first('name') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Imagen') }}</label>
                                <input type="file" name="image" class="form-control">
                                <small>No es necesario</small>
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

@endsection
