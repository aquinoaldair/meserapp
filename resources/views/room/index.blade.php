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
        <table-component></table-component>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="{{ mix('js/app.js') }}"></script>
@endsection
