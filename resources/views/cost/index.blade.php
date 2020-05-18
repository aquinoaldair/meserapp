@extends('layouts.master')

@section('title',  __(\App\Models\Cost::NAME))

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/daterange-picker.css')}}">
@endsection


@section('breadcrumb-title',  __(\App\Models\Cost::NAME))
@section('breadcrumb-item')
    <li class="breadcrumb-item active">{{ __(\App\Models\Cost::NAME)}}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 col-sm-3 col-md-3 mb-2">
                                <a href="{{ route('cost.create') }}" class="btn btn-primary text-white" type="button">
                                    <i class="fa fa-plus"></i>&nbsp;{{ __("Agregar Nuevo") }}
                                </a>
                            </div>
                            <div class="col-12 col-sm-9 col-md-9">
                               <div class="row">
                                   <div class="col-12 col-md-12 col-lg-8">
                                       <form class="form-inline" action="{{ route('cost.index') }}" method="get">
                                           <div class="form-group  mb-2">
                                               <label for="inputPassword2" class="sr-only">{{ __("Fechas") }}</label>
                                               <input class="form-control digits" type="text" name="daterange">
                                           </div>
                                           <div class="form-group  mb-2">
                                               <label for="inputPassword2" class="sr-only">{{ __("Proveedor") }}</label>
                                               <select name="supplier_id" id="" class="form-control">
                                                   <option value="" selected disabled>Seleccionar</option>
                                                   @foreach($suppliers as $item)
                                                       <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                   @endforeach
                                               </select>
                                           </div>
                                           <button type="submit" class="btn btn-secondary mb-2">  <i class="fa fa-search"></i> Buscar</button>
                                       </form>
                                   </div>
                                   <div class="col-12 col-md-12 col-lg-4">
                                       <h5 class="text-center">Total: $<strong>{{ number_format($data->sum('cost'), 2) }}</strong></h5>
                                   </div>
                               </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="datatableButtons">
                                <thead>
                                <tr>
                                    <th>{{ __('Nombre') }}</th>
                                    <th>{{ __('Gasto') }}</th>
                                    <th>{{ __('Proveedor') }}</th>
                                    <th>{{ __('Factura') }}</th>
                                    <th>{{ __('Fecha') }}</th>
                                    <th>{{ __('Hora') }}</th>
                                    <th>{{ __('Acciones') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr data-id="{{ $item->id }}">
                                        <td>{{ $item->name }}</td>
                                        <td>$ {{ $item->cost }}</td>
                                        <td>{{ $item->supplier->name }}</td>
                                        <td>{{ $item->bill }}</td>
                                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                                        <td>{{ $item->created_at->format('H:i:s') }}</td>
                                        <td>
                                            <a href="{{ route('cost.edit', $item) }}" class="btn btn-pill btn-info text-white"  data-toggle="tooltip" title="" data-original-title="{{ __("Editar") }}">
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
    <form action="{{route('cost.destroy', ':data-id')}}" id="form-destroy">@csrf</form>
    <!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/jszip.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.colVis.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/vfs_fonts.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/buttons.html5.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatable-extension/responsive.bootstrap4.min.js')}}"></script>
    <script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/custom.js') }}"></script>
    <script src="{{asset('assets/js/datepicker/daterange-picker/moment.min.js')}}"></script>
    <script src="{{asset('assets/js/datepicker/daterange-picker/daterangepicker.js')}}"></script>

    <script>
        $(function() {
            $('input[name="daterange"]').daterangepicker({
                timePicker: false,
                startDate: moment().startOf('hour'),
                endDate: moment().startOf('hour'),
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });
        });
    </script>

@endsection
