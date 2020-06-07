@extends('layouts.master')

@section('title',  __('Horario'))

@section('style')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/timepicker.css')}}">
@endsection

@section('breadcrumb-title',  __('Horario'))
@section('breadcrumb-item')
    <li class="breadcrumb-item active">{{ __('Horario') }}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row mt-4">
            <form action="{{ route('schedule.store') }}" method="post">
                @csrf
                <div class="card" style="width: 100%">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr class="thead-dark">
                                <th scope="col">Hora</th>
                                <th scope="col">Lunes</th>
                                <th scope="col">Martes</th>
                                <th scope="col">Miercoles</th>
                                <th scope="col">Jueves</th>
                                <th scope="col">Viernes</th>
                                <th scope="col">Sabado</th>
                                <th scope="col">Domingo</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <th scope="row">Inicio</th>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input name="start.monday" class="form-control" type="text" value="{{ ($schedule_start) ? $schedule_start->monday  : '09:30' }}"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input name="start.tuesday" class="form-control" type="text" value="{{ ($schedule_start) ? $schedule_start->tuesday  : '09:30' }}"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input name="start.wednesday" class="form-control" type="text" value="{{ ($schedule_start) ? $schedule_start->wednesday  : '09:30' }}"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input  name="start.thursday" class="form-control" type="text" value="{{ ($schedule_start) ? $schedule_start->thursday  : '09:30' }}"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input name="start.friday" class="form-control" type="text" value="{{ ($schedule_start) ? $schedule_start->friday  : '09:30' }}"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input name="start.saturday" class="form-control" type="text" value="{{ ($schedule_start) ? $schedule_start->saturday  : '09:30' }}"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input name="start.sunday" class="form-control" type="text" value="{{ ($schedule_start) ? $schedule_start->sunday  : '00:00' }}"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">Fin</th>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input name="end.monday" class="form-control" type="text" value="{{ ($schedule_end) ? $schedule_end->monday  : '22:00' }}"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input name="end.tuesday" class="form-control" type="text" value="{{ ($schedule_end) ? $schedule_end->tuesday  : '22:00' }}"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input name="end.wednesday" class="form-control" type="text" value="{{ ($schedule_end) ? $schedule_end->wednesday  : '22:00' }}"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input  name="end.thursday" class="form-control" type="text" value="{{ ($schedule_end) ? $schedule_end->thursday  : '22:00' }}"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input name="end.friday" class="form-control" type="text" value="{{ ($schedule_end) ? $schedule_end->friday  : '22:00' }}"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input name="end.saturday" class="form-control" type="text" value="{{ ($schedule_end) ? $schedule_end->saturday  : '22:00' }}"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                </td>
                                <td>
                                    <div class="input-group clockpicker">
                                        <input name="end.sunday" class="form-control" type="text" value="{{ ($schedule_end) ? $schedule_end->sunday  : '00:00' }}"><span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-lg btn-success">Guardar</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="{{asset('assets/js/time-picker/jquery-clockpicker.min.js')}}"></script>
    <script src="{{asset('assets/js/time-picker/highlight.min.js')}}"></script>
    <script src="{{asset('assets/js/time-picker/clockpicker.js')}}"></script>
@endsection
