@extends('layouts.master')

@section('title',  __('Comercios'))

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
@endsection

@section('breadcrumb-title',  __('Comercios'))

@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('commerce.index') }}">{{ __('Comercios') }}</a></li>
    <li class="breadcrumb-item active">{{ __('Crear') }}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-6">
                <div class="card">
                    <form action="{{ route('commerce.store') }}" enctype="multipart/form-data" method="post" class="theme-form" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <h6 class="text-center text-muted pb-2">{{ __("Datos del Comercio") }}</h6>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{ __('Nombre') }}</label>
                                    <input required type="text" name="name" class="form-control">
                                    @error('name')
                                    <p class="text-danger text-sm"> {{ $errors->first('name') }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{ __("Fecha creación") }}</label>
                                    <input class="datepicker-here form-control digits" name="date" type="text" data-language="en">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>{{ __('Logotipo') }}</label>
                                    <input type="file" name="logo" class="form-control">
                                </div>
                            </div>
                            <h6 class="text-center text-muted pb-2">{{ __("Datos Contacto") }}</h6>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{ __('Propietario') }}</label>
                                    <input required type="text" name="customer" class="form-control">
                                    @error('customer')
                                    <p class="text-danger text-sm"> {{ $errors->first('customer') }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{ __("Número de teléfono") }}</label>
                                    <input type="text" name="phone_number" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label>{{ __('Dirección') }}</label>
                                    <input type="text" name="address" class="form-control">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>{{ __('Email') }}</label>
                                    <input required type="email" name="email" class="form-control">
                                    @error('email')
                                    <p class="text-danger text-sm"> {{ $errors->first('email') }}</p>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label>{{ __("Contraseña") }}</label>
                                    <input required type="password" name="password" class="form-control">
                                    @error('password')
                                    <p class="text-danger text-sm"> {{ $errors->first('password') }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp; {{ __("Guardar") }}</button>
                            <a class="btn btn-secondary text-white" href="{{ route('commerce.index') }}" ><i class="fa fa-mail-reply"></i>&nbsp;{{ __("Cancelar") }}</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="{{asset('assets/js/datepicker/date-picker/datepicker.js')}}"></script>
    <script src="{{asset('assets/js/datepicker/date-picker/datepicker.es.js')}}"></script>
@endsection
