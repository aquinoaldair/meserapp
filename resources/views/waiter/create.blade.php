@extends('layouts.master')

@section('title',  __(\App\Models\Waiter::NAME))

@section('style')

@endsection

@section('breadcrumb-title',  __(\App\Models\Waiter::NAME))

@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('waiter.index') }}">{{ __(\App\Models\Waiter::NAME) }}</a></li>
    <li class="breadcrumb-item active">{{ __('Crear') }}</li>
@endsection

@section('body')

    <!-- Container-fluid starts-->
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-sm-12 col-xl-4">
                <div class="card">
                    <form action="{{ route('waiter.store') }}" method="post" class="theme-form" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('Nombre') }}</label>
                                <input required type="text" name="name" value="{{ old('name') }}" class="form-control">
                                @error('name')
                                <p class="text-danger text-sm"> {{ $errors->first('name') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Email') }}</label>
                                <input required type="text" name="email" value="{{ old('email') }}" class="form-control">
                                @error('email')
                                <p class="text-danger text-sm"> {{ $errors->first('email') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Contraseña') }}</label>
                                <input required type="password" name="password" class="form-control">
                                @error('password')
                                <p class="text-danger text-sm"> {{ $errors->first('password') }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Dirección') }}</label>
                                <input type="text" name="address" value="{{ old('address') }}" class="form-control">
                                @error('address')
                                <p class="text-danger text-sm"> {{ $errors->first('address') }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>{{ __('Teléfono') }}</label>
                                <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                                @error('phone')
                                <p class="text-danger text-sm"> {{ $errors->first('phone') }}</p>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp; {{ __("Guardar") }}</button>
                            <a class="btn btn-secondary text-white" href="{{ route('waiter.index') }}" ><i class="fa fa-mail-reply"></i>&nbsp;{{ __("Cancelar") }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script src="{{ asset('js/app.js') }}"></script>
@endsection
