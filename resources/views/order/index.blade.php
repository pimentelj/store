<!-- Stored in resources/views/child.blade.php -->

@extends('layout.app')

@section('content')
<div class="row mb-2">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Listado de ordenes
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Referencia</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha</th>
                            <th scope="col">Detalle</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <th scope="row">{{$order->id}}</th>
                            <td>${{number_format($order->amount)}}</td>
                            <td>@if($order['status'] == 'CREATED')
                                CREADO
                                @elseif($order['status'] == 'PAYED')
                                PAGADO
                                @elseif($order['status'] == 'REJECTED')
                                RECHAZADO
                                @endif
                            </td>
                            <td>{{\Carbon\Carbon::parse($order->created_at)->format('d/m/Y H:i:s')}}</td>
                            <td><a href="{{route('order.show', [$order->id])}}">Ver</a></td>
                        </tr>                        
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection