@extends('layouts.master')

@section('title', 'Estado Actual de mesas')

@section('style')
@endsection

@section('breadcrumb-title', 'Estado Actual de mesas')
@section('breadcrumb-item')

@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid" id="app">
        <dashboard-client></dashboard-client>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="{{mix('js/app.js') }}"></script>
@endsection
