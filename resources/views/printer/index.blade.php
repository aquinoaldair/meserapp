@extends('layouts.master')

@section('title',  __(\App\Models\Printer::NAME))

@section('style')

@endsection

@section('breadcrumb-title',  __(\App\Models\Printer::NAME))

@section('breadcrumb-item')
    <li class="breadcrumb-item active">{{ __('Crear') }}</li>
@endsection

@section('body')

    <!-- Container-fluid starts-->
    <div class="container-fluid" id="app">
        <div class="row">
            <div class="col-sm-12 col-xl-4">
                <div class="card">
                    <form action="{{ route('printer.store') }}" enctype="multipart/form-data" method="post" class="theme-form" autocomplete="off">
                        @csrf
                        <div class="card-body">
                            <div class="form-group">
                                <label>{{ __('Texto Superior') }}</label>
                                <input required type="text" name="top_text" class="form-control" value="{{ $printer->top_text }}" placeholder="Restaurante doña martha">
                                @error('top_text')
                                <p class="text-danger text-sm"> {{ $errors->first('top_text') }}</p>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label>{{ __('Texto Inferior') }}</label>
                                <input required type="text" name="bottom_text" class="form-control" value="{{ $printer->bottom_text }}" placeholder="Gracias por su compra">
                                @error('bottom_text')
                                <p class="text-danger text-sm"> {{ $errors->first('bottom_text') }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="card-footer">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-check"></i>&nbsp; {{ __("Guardar") }}</button>
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
