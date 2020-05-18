@extends('layouts.master')

@section('title',  __(\App\Models\Cost::NAME))

@section('style')

@endsection

@section('breadcrumb-title',  __(\App\Models\Cost::NAME))

@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('cost.index') }}">{{ __(\App\Models\Cost::NAME) }}</a></li>
    <li class="breadcrumb-item active">{{ __('Crear') }}</li>
@endsection

@section('body')

    <!-- Container-fluid starts-->
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-sm-12 col-xl-4">
                <div class="card">
                    <form action="{{ route('cost.update', $cost) }}" enctype="multipart/form-data" method="post" class="theme-form" autocomplete="off">
                        @csrf
                        @method('put')
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('Nombre') }}</label>
                                <input required type="text" name="name" value="{{ old('name') ?? $cost->name }}" class="form-control">
                                @error('name')
                                <p class="text-danger text-sm"> {{ $errors->first('name') }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Proveedor') }}</label>
                                <select name="supplier_id" class="form-control">
                                    <option value="" selected disabled hidden>{{ __("Selecciona") }}</option>
                                    <option value="">{{ __("Ninguno") }}</option>
                                    @foreach($suppliers as $supplier)
                                        <option {{ old('supplier_id')  == $supplier->id ? "selected" : ($supplier->id == $cost->supplier_id) ? "selected" : "" }} value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                    @endforeach
                                </select>
                                @error('supplier_id')
                                <p class="text-danger text-sm"> {{ $errors->first('supplier_id') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <label>{{ __('Valor') }}</label>
                                        <input required type="number" value="{{ old('cost') ?? $cost->cost }}" name="cost" step='0.01' value='0.00' class="form-control">
                                        @error('cost')
                                        <p class="text-danger text-sm"> {{ $errors->first('cost') }}</p>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label>{{ __('No Factura') }}</label>
                                        <input type="text" name="bill"  value="{{ old('bill') ?? $cost->bill }}" class="form-control">
                                        @error('bill')
                                        <p class="text-danger text-sm"> {{ $errors->first('bill') }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Descripcion') }}</label>
                                    <input  type="text" name="description" value="{{ old('description') ?? $cost->description }}" class="form-control">
                                    @error('description')
                                    <p class="text-danger text-sm"> {{ $errors->first('description') }}</p>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label>{{ __('Comentarios') }}</label>
                                    <input type="text" name="comment" value="{{ old('comment') ?? $cost->comment  }}" class="form-control">
                                    @error('comment')
                                    <p class="text-danger text-sm"> {{ $errors->first('comment') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp; {{ __("Guardar") }}</button>
                            <a class="btn btn-secondary text-white" href="{{ route('cost.index') }}" ><i class="fa fa-mail-reply"></i>&nbsp;{{ __("Cancelar") }}</a>
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
@endsection

@section('script')
@endsection
