<!-- Stored in resources/views/child.blade.php -->

@extends('layout.app')

@section('content')
<div class="row">
    <div class="col-sm-12 col-md-7">
        <div class="card">
            <div class="card-header">
                Resumen de la orden
            </div>
            <div class="card-body">
                <form action="{{route('order.store')}}" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="customer_name" class="col-sm-5 col-form-label">Nombres Completos</label>
                        <div class="col-sm-7" style="padding: 7px 0;">
                            <input type="hidden" name="customer_name" value="{{$order['customer_name']}}" />
                            <b>{{$order['customer_name']}}</b>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customer_email" class="col-sm-5 col-form-label">Correo Electronico</label>
                        <div class="col-sm-7" style="padding: 7px 0;">
                            <input type="hidden" name="customer_email" value="{{$order['customer_email']}}" />
                            <b>{{$order['customer_email']}}</b>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="customer_mobile" class="col-sm-5 col-form-label">Número Celular</label>
                        <div class="col-sm-7" style="padding: 7px 0;">
                            <input type="hidden" name="customer_mobile" value="{{$order['customer_mobile']}}" />
                            <b>{{$order['customer_mobile']}}</b>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="amount" class="col-sm-5 col-form-label">Total a pagar</label>
                        <div class="col-sm-7" style="padding: 7px 0;">
                            <input type="hidden" name="amount" value="{{$order['amount']}}" />
                            <b>${{number_format($order['amount'])}}</b>
                        </div>
                    </div>
                    <input type="submit" class="btn btn-primary btn-lg" value="Pagar">
                </form>
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
                        @foreach($products as $product)
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