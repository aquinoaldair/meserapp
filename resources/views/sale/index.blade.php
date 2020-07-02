@extends('layouts.master')

@section('title',  __(\App\Models\Sale::NAME))

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/datatable-extension.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/daterange-picker.css')}}">
@endsection


@section('breadcrumb-title',  __(\App\Models\Sale::NAME))
@section('breadcrumb-item')
    <li class="breadcrumb-item active">{{ __(\App\Models\Sale::NAME)}}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-12 col-md-12 col-lg-12">
                                        <form class="form-inline" action="{{ route('sale.index') }}" method="get">
                                            <div class="form-group  mb-2">
                                                <label for="inputPassword2" class="sr-only">{{ __("Fechas") }}</label>
                                                <input class="form-control digits" type="text" name="daterange">
                                            </div>
                                            <button type="submit" class="btn btn-secondary mb-2">  <i class="fa fa-search"></i> Buscar</button>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="display" id="datatable">
                                <thead>
                                <tr>
                                    <th>{{ __('Mesa') }}</th>
                                    <th>{{ __("Ordenes") }}</th>
                                    <th>{{ __('Fecha') }}</th>
                                    <th>{{ __("Total") }}</th>
                                    <th>{{ __('Acciones') }}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $item)
                                    <tr data-id="{{ $item->id }}">
                                        <td>{{ $item->table->name }}</td>
                                        <td>{{ count($item->orders) }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>$ {{ $item->total }}</td>
                                        <td>
                                            <a href="{{ route('sale.show', $item) }}" class="btn btn-pill btn-info text-white"  data-toggle="tooltip" title="" data-original-title="{{ __("Mostrar") }}">
                                                <i class="fa fa-eye"></i>
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
@endsection

@section('script')
    <script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('assets/js/datatable/datatables/datatable.custom.js')}}"></script>
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
