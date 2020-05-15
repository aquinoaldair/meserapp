@extends('layouts.master')

@section('title',  __(\App\Models\Category::NAME))

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
@endsection


@section('breadcrumb-title',  __(\App\Models\Category::NAME))
@section('breadcrumb-item')
    <li class="breadcrumb-item active">{{ __(\App\Models\Category::NAME)}}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        @include('components.alert')
                        <a href="{{ route('category.create') }}" class="btn btn-primary text-white" type="button">
                            <i class="fa fa-plus"></i>&nbsp;{{ __("Agregar Nuevo") }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="datatable">
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
    <form action="{{route('category.destroy', ':data-id')}}" id="form-destroy">@csrf</form>
    <!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
    <script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/custom.js') }}"></script>
@endsection
