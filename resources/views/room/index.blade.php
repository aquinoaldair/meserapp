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
    <div class="container-fluid">
        <div class="row container">
            <a href="{{ route('room.create') }}" class="btn btn-success text-white" type="button">
                <i class="fa fa-plus"></i>&nbsp;{{ __("Agregar Nuevo") }}
            </a>
        </div>
        <div class="row mt-4">
            @foreach($data as $item)
                <div class="col-12 col-sm-6 col-lg-4" id="{{$item->key}}">
                    <div class="card card-absolute">
                            <div class="card-header bg-primary">
                                <h6>{{ $item->name}}</h6>
                            </div>
                            <div class="card-body">
                                <div class="row justify-content-center mt-2">
                                    <div class="col-8">
                                        <a href="{{ route('table.index', $item) }}" class="btn btn-pill btn-sm btn-outline-success" type="button" data-original-title="Mesas" title="">
                                            <i data-feather="grid"></i>
                                        </a>
                                        <a href="{{ route('room.edit', $item) }}" class="btn btn-pill btn-sm btn-outline-primary" type="button" data-original-title="Editar" title="">
                                            <i data-feather="edit-3"></i>
                                        </a>
                                    </div>
                                    <div class="col-4">
                                        <button class="btn btn-pill btn-sm btn-outline-danger room-delete" data-key="{{$item->key}}" type="button" data-original-title="Eliminar" title="">
                                            <i data-feather="trash-2"></i>
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>
                </div>
            @endforeach
        </div>
    </div>
    <form action="{{route('room.destroy', ':data-id')}}" id="form-destroy">@csrf</form>
    <!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/custom.js') }}"></script>
@endsection
