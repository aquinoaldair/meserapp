@extends('layouts.master')

@section('title',  __('Comercios'))

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
@endsection

@section('breadcrumb-title',  __(\App\Models\Commerce::NAME))
@section('breadcrumb-item')
    <li class="breadcrumb-item active">{{ __(\App\Models\Commerce::NAME) }}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        @include('components.alert')
                        <a href="{{ route('commerce.create') }}" class="btn btn-primary text-white" type="button">
                            <i class="fa fa-plus"></i>&nbsp;{{ __("Agregar Nuevo") }}
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="datatable">
                                <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>{{ __('Propietario') }}</th>
                                    <th>{{ __("Logotipo") }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th>{{ __('Teléfono') }}</th>
                                    <th>{{ __('Creado') }}</th>
                                    <th>{{ __('Acciones') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr data-id="{{ $item->id }}">
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->user->name }}</td>
                                        <td>
                                           @if ($item->logo)
                                                <a target="_blank" href="{{ asset('storage/'.$item->logo) }}">
                                                    <img style="width: 50px" src="{{ asset('storage/'.$item->logo) }}" alt="">
                                                </a>
                                           @endif
                                        </td>
                                        <td>{{ $item->user->email }}</td>
                                        <td>{{ $item->phone_number }}</td>
                                        <td>{{ $item->date }}</td>
                                        <td>
                                            <a href="{{ route('commerce.edit', $item) }}" class="btn btn-pill btn-info text-white"  data-toggle="tooltip" title="" data-original-title="{{ __("Editar") }}">
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
    <form action="{{route('commerce.destroy', ':data-id')}}" id="form-destroy">@csrf</form>
    <!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
    <script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/custom.js') }}"></script>
@endsection
