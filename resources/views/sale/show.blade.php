@extends('layouts.master')

@section('title',  __(\App\Models\Sale::NAME))

@section('style')
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
                    <div class="card-body">
                        <h1>Total : ${{ $service->total }}</h1>
                        <hr>
                        @foreach($service->orders as $order)
                            <h4>Orden {{ $loop->iteration }}</h4>
                            <table class="table table-bordered" width="100%">
                                <tr>
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total</th>
                                </tr>
                                @foreach($order->details as $detail)
                                    <tr>
                                        <td>{{ $detail->product->name }}</td>
                                        <td>{{ $detail->quantity }}</td>
                                        <td>{{ $detail->price }}</td>
                                        <td>${{ $detail->price *  $detail->quantity}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
