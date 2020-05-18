@extends('layouts.master')

@section('title',  __('Salones'))

@section('style')
    <style>svg{
            width: 100% !important;
        }</style>
@endsection

@section('breadcrumb-title',  __($room->name)." / ".\App\Models\Table::NAME)
@section('breadcrumb-item')
    <li class="breadcrumb-item"><a href="{{ route('room.index') }}">{{ __(\App\Models\Room::NAME) }}</a></li>
    <li class="breadcrumb-item active">{{ __(\App\Models\Table::NAME)}}</li>
@endsection

@section('body')
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row container">
            <a href="{{ route('table.create', $room) }}" class="btn btn-primary text-white" type="button">
                <i class="fa fa-plus"></i>&nbsp;{{ __("Agregar Nuevo") }}
            </a>
            <button type="button" class="ml-2 btn btn-sm btn-success">Activos</button>
            <button type="button" class="ml-2 btn btn-sm btn-warning">Ocupados</button>
        </div>
        <div class="row mt-4">
            @foreach($data as $item)
                <div class="col-12 col-sm-6 col-lg-3" id="{{$item->key}}">
                    <div class="card card-absolute">
                        <div class="card-header {{ $item->status == 'active' ? 'bg-success' : 'bg-warning' }}">
                            <h6>{{ $item->name}}</h6>
                        </div>
                        <div class="card-body">
                            <div class="row justify-content-center mt-2">
                                <div class="col-8 text-center">
                                   <div class="container  d-flex h-100">
                                      <div class="row text-center justify-content-center align-self-center">
                                          <a href="{{ route('table.edit', ['room' => $room, 'table' => $item]) }}"
                                             class="btn btn-pill btn-sm btn-outline-primary"
                                             type="button" data-original-title="Editar" title="">
                                              <i data-feather="edit-3"></i>
                                          </a>
                                          <button class="btn btn-pill btn-sm btn-outline-danger room-delete ml-2" data-key="{{$item->key}}" type="button" data-original-title="Eliminar" title="">
                                              <i data-feather="trash-2"></i>
                                          </button>
                                      </div>
                                   </div>
                                </div>
                                <div class="col-4 justify-content-center">
                                    {!! \SimpleSoftwareIO\QrCode\Facades\QrCode::margin(0)->size('100')->generate(route('table.qr', ['qr' => $item->key])) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <form action="{{route('table.destroy', ['room' => $room, 'table' => ':data-id'])}}" id="form-destroy">@csrf</form>
    <!-- Container-fluid Ends-->
@endsection

@section('script')
    <script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
    <script src="{{asset('js/custom.js') }}"></script>
@endsection
