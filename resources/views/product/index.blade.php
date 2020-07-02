@extends('layouts.master')

@section('title',  __(\App\Models\Product::NAME))

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">

    <style>
        .cardHeader{
            padding: 10px !important;
        }
        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            background-color: #EA5A61 !important;
        }
    </style>
@endsection

@section('breadcrumb-title',  __(\App\Models\Product::NAME))
@section('breadcrumb-item')
    <li class="breadcrumb-item active">{{ __(\App\Models\Product::NAME)}}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
               <div class="card">
                   <div class="card-body">
                       <ul class="nav nav-tabs" id="myTab" role="tablist">
                           <li class="nav-item">
                               <a class="nav-link active show" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="false" data-original-title="" title="">
                                   Productos
                               </a>
                           </li>
                           <li class="nav-item">
                               <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="true" data-original-title="" title="">
                                   Categoria
                               </a>
                           </li>
                       </ul>
                       <div class="tab-content" id="myTabContent">
                           <div class="tab-pane fade  active show" id="home" role="tabpanel" aria-labelledby="home-tab">
                               @include('product.components.product', ['categories' => $data])
                           </div>
                           <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                               @include('product.components.category', ['categories' => $data])
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
    <form action="{{route('product.destroy', ':data-id')}}" id="form-destroy">@csrf</form>
    <form action="{{route('category.destroy', ':data-id')}}" id="form-reload">@csrf</form>
@endsection
@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
    <script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{ mix('js/custom.js') }}"></script>
@endsection
