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
                               <div class="card">
                                   <div class="card-header cardHeader">
                                       <a href="{{ route('product.create') }}" class="btn btn-primary text-white" type="button">
                                           <i class="fa fa-plus"></i>&nbsp;{{ __("Agregar Nuevo") }}
                                       </a>
                                   </div>
                                   <div class="card-body">
                                       <div class="row">
                                           <div class="col-sm-3 col-xs-12">
                                               <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                                   @foreach($data as $category)
                                                       <a class="nav-link {{ $loop->index == 0 ? "active show" : "" }}" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-{{$category->id}}" role="tab" aria-controls="v-pills-home" aria-selected="false" data-original-title="" title="">
                                                           {{ $category->name }}
                                                       </a>
                                                   @endforeach
                                               </div>
                                           </div>
                                           <div class="col-sm-9 col-xs-12">
                                               <div class="tab-content" id="v-pills-tabContent">
                                                   @foreach($data as $category)
                                                       <div class="tab-pane fade {{ $loop->index == 0 ? "active show" : "" }}" id="v-pills-{{ $category->id }}" role="tabpanel" aria-labelledby="v-pills-home-tab">
                                                           <div class="table-responsive">
                                                               <table class="display datatable">
                                                                   <thead>
                                                                   <tr>
                                                                       <th>{{ __('Nombre') }}</th>
                                                                       <th>{{ __('Precio') }}</th>
                                                                       <th>{{ __('Imagen') }}</th>
                                                                       <th>{{ __('Stock') }}</th>
                                                                       <th>{{ __("Margen") }}</th>
                                                                       <th>{{ __('Acciones') }}</th>
                                                                   </tr>
                                                                   </thead>
                                                                   <tbody>
                                                                   @foreach($category->products as $item)
                                                                       <tr data-id="{{ $item->id }}">
                                                                           <td>{{ $item->name }}</td>
                                                                           <td>{{ $item->price }}</td>
                                                                           <td>
                                                                               @if ($item->image)
                                                                                   <img src="{{ asset('storage/'.$item->image) }}" alt="" style="width: 30px; height: 30px">
                                                                               @endif
                                                                           </td>
                                                                           <td>{{ $item->stock }}</td>
                                                                           <td>{{ $item->margin }}</td>
                                                                           <td>
                                                                               <a href="{{ route('product.edit', $item) }}" class="btn btn-pill btn-info text-white"  data-toggle="tooltip" title="" data-original-title="{{ __("Editar") }}">
                                                                                   <i class="fa fa-edit"></i>
                                                                               </a>
                                                                               <a class="btn btn-pill btn-danger text-white destroy"  data-toggle="tooltip" title="" data-original-title="{{ __("Eliminar") }}">
                                                                                   <i class="fa fa-trash"></i>
                                                                               </a>
                                                                           </td>
                                                                       </tr>
                                                                   @endforeach
                                                                   </tbody>
                                                               </table>
                                                           </div>
                                                       </div>
                                                   @endforeach
                                               </div>
                                           </div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                               <div class="card">
                                   <div class="card-header cardHeader">
                                       <a href="{{ route('category.create') }}" class="btn btn-primary text-white" type="button">
                                           <i class="fa fa-plus"></i>&nbsp;{{ __("Agregar Nuevo") }}
                                       </a>
                                   </div>
                                   <div class="card-body">
                                       <div class="table-responsive">
                                           <table class="display datatable" id="datatableCategory">
                                               <thead>
                                               <tr>
                                                   <th>{{ __('Nombre') }}</th>
                                                   <th>{{ __('Imagen') }}</th>
                                                   <th>{{ __('Acciones') }}</th>
                                               </tr>
                                               </thead>
                                               <tbody>
                                               @foreach($data as $item)
                                                   <tr data-id="{{ $item->id }}">
                                                       <td>{{ $item->name }}</td>
                                                       <td>
                                                           @if ($item->image)
                                                               <img src="{{ asset('storage/'.$item->image) }}" alt="" style="width: 30px; height: 30px">
                                                           @endif
                                                       </td>
                                                       <td>
                                                           <a href="{{ route('category.edit', $item) }}" class="btn btn-pill btn-info text-white"  data-toggle="tooltip" title="" data-original-title="{{ __("Editar") }}">
                                                               <i class="fa fa-edit"></i>
                                                           </a>
                                                           <a class="btn btn-pill btn-danger text-white destroy"  data-toggle="tooltip" title="" data-original-title="{{ __("Eliminar") }}">
                                                               <i class="fa fa-trash"></i>
                                                           </a>
                                                       </td>
                                                   </tr>
                                               @endforeach
                                               </tbody>
                                           </table>
                                       </div>
                                   </div>
                               </div>
                           </div>
                       </div>
                   </div>
               </div>
            </div>
        </div>
    </div>
    <form action="{{route('product.destroy', ':data-id')}}" id="form-destroy">@csrf</form>
    <form action="{{route('category.destroy', ':data-id')}}" id="form-destroy-2">@csrf</form>
@endsection
@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
    <script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/custom.js') }}"></script>
@endsection
