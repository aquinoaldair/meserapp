@extends('layouts.master')

@section('title', 'Estado Actual de mesas')

@section('style')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
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
