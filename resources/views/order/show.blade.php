<!-- Stored in resources/views/child.blade.php -->

@extends('layout.app')

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-7">
        <div class="card">
            <div class="card-header">
                Estado de la orden
            </div>
            <div class="card-body">
                <div class="form-group row">
                    <label for="customer_name" class="col-sm-5 col-form-label">Nombres Completos</label>
                    <div class="col-sm-7" style="padding: 7px 0;">                            
                        <b>{{$order['customer_name']}}</b>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="customer_email" class="col-sm-5 col-form-label">Correo Electronico</label>
                    <div class="col-sm-7" style="padding: 7px 0;">
                        <b>{{$order['customer_email']}}</b>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="customer_mobile" class="col-sm-5 col-form-label">Número Celular</label>
                    <div class="col-sm-7" style="padding: 7px 0;">
                        <b>{{$order['customer_mobile']}}</b>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="amount" class="col-sm-5 col-form-label">Valor</label>
                    <div class="col-sm-7" style="padding: 7px 0;">
                        <b>${{number_format($order['amount'])}}</b>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="status" class="col-sm-5 col-form-label">Estado</label>
                    <div class="col-sm-7" style="padding: 7px 0;">
                        @if($order['status'] == 'CREATED')
                        <b>CREADO</b>
                        @elseif($order['status'] == 'PAYED')
                        <b class="text-success">PAGADO</b>
                        @elseif($order['status'] == 'REJECTED')
                        <b class="text-danger">RECHAZADO</b>
                        @endif
                    </div>
                </div>
                @if($order['status'] == 'CREATED')
                <a href="{{$order->placetopay_url}}" class="btn btn-primary btn-lg">Pagar</a>
                @elseif($order['status'] == 'REJECTED')
                <form action="{{route('order.pay.again')}}" method="post">
                    @csrf
                    <input type="hidden" name="order" value="{{$order->id}}"/>
                    <input type="submit" class="btn btn-primary btn-lg" value="Volver a Pagar">
                </form>
                @endif
            </div>
        </div>
    </div>
    <div class="col-sm-12 col-md-5">
        <div class="card">
            <div class="card-header">
                <i class="fa fa-shopping-cart" aria-hidden = "true"></i> Productos en el carro
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Precio</th>        
                        </tr>
                    </thead>
                    <tbody>
                        @php $total = 0; @endphp
                        @foreach($order->products()->get() as $product)
                        <tr>
                            <th scope="row">{{$loop->iteration}}</th>
                            <td>{{$product->name}}</td>
                            <td>${{number_format($product->price)}}</td>                
                        </tr>
                        @php $total += $product->price; @endphp
                        @endforeach
                        <tr>
                            <th scope="row"></th>
                            <th>Total</th>
                            <th>${{number_format($total)}}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection