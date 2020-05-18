@extends('layouts.master')

@section('title',  __(\App\Models\Supplier::NAME))

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/select2.css')}}">

    <style>
        .select2-results__option{
            color: gray !important;
        }
    </style>
@endsection

@section('breadcrumb-title',  __(\App\Models\Supplier::NAME))

@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('supplier.index') }}">{{ __(\App\Models\Supplier::NAME) }}</a></li>
    <li class="breadcrumb-item active">{{ __('Crear') }}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-4">
                <div class="card">
                    <form action="{{ route('supplier.store') }}"  method="post" class="theme-form" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <h6 class="text-center text-muted pb-2">{{ __("Datos del Proveedor") }}</h6>
                            <div class="form-group">
                                <label>{{ __('Nombre') }}</label>
                                <input required type="text" name="name" class="form-control">
                                @error('name')
                                <p class="text-danger text-sm"> {{ $errors->first('name') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Dirección') }}</label>
                                <input required type="text" name="address" class="form-control">
                                @error('address')
                                <p class="text-danger text-sm"> {{ $errors->first('address') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Teléfono') }}</label>
                                <input required type="text" name="phone_number" class="form-control">
                                @error('phone_number')
                                <p class="text-danger text-sm"> {{ $errors->first('phone_number') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Productos') }} <small>({{ __("Selecciona uno o mas productos") }})</small></label>
                                <select name="products[]" id="products" class="form-control form-control-primary btn-square" multiple="multiple">
                                    @foreach($products as $item)
                                        <option class="text-muted" value="{{ $item->id }}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('products')
                                <p class="text-danger text-sm"> {{ $errors->first('products') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp; {{ __("Guardar") }}</button>
                            <a class="btn btn-secondary text-white" href="{{ route('supplier.index') }}" ><i class="fa fa-mail-reply"></i>&nbsp;{{ __("Cancelar") }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="{{asset('assets/js/select2/select2.full.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#products').select2();
        });
    </script>
@endsection
