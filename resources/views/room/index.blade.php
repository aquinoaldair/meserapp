@extends('layouts.master')

@section('title',  __('Salones'))

@section('style')

@endsection

@section('breadcrumb-title',  __('Salones'))
@section('breadcrumb-item')
    <li class="breadcrumb-item active">{{ __('Salones') }}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid" id="app">
        <table-component
            room-delete="{{ route('room.destroy', ':key') }}"
            room-store="{{ route('room.store') }}"
            room-update="{{ route('room.update', ':key') }}"

            table-delete="{{ route('table.destroy', ['room' => ':room', 'table' => ':table']) }}"
            table-store="{{ route('table.store', ['room' => ':room']) }}"
            table-update="{{ route('table.update', ['room' => ':room', 'table' => ':table']) }}"

            table-qr="{{ route('table.qr', ['qr' => ":qr"]) }}"

        ></table-component>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
