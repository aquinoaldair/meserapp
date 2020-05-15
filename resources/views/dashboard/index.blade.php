@extends('layouts.master')

@section('title', 'DashBoard')

@section('style')
@endsection

@section('breadcrumb-title', 'Dashboard')
@section('breadcrumb-item')
    <li class="breadcrumb-item">Admin</li>
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <h1 class="text-center text-white">DashBoard</h1>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@section('script')

@endsection
