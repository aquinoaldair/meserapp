@extends('layouts.master')

@section('title',  __(\App\Models\Table::NAME))

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/date-picker.css')}}">
@endsection

@section('breadcrumb-title',  __(\App\Models\Table::NAME))

@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('room.index') }}">{{ __(\App\Models\Room::NAME) }}</a></li>
    <li class="breadcrumb-item"><a href="{{ route('table.index', $room) }}">{{ __(\App\Models\Table::NAME) }}</a></li>
    <li class="breadcrumb-item active">{{ __("Crear") }}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12 col-xl-4">
                <div class="card">
                    <form action="{{ route('table.store', $room) }}" enctype="multipart/form-data" method="post" class="theme-form" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <h6 class="text-center text-muted pb-2">{{ __("Datos de la mesa") }}</h6>
                            <div class="form-group">
                                <label>{{ __('Número') }}</label>
                                <input required type="number" name="name" class="form-control">
                                @error('name')
                                <p class="text-danger text-sm"> {{ $errors->first('name') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp; {{ __("Guardar") }}</button>
                            <a class="btn btn-secondary text-white" href="{{ route('table.index', $room) }}" ><i class="fa fa-mail-reply"></i>&nbsp;{{ __("Cancelar") }}</a>
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
