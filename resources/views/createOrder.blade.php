<!-- Stored in resources/views/child.blade.php -->

@extends('layout.app')

@section('content')
<div class="row mb-2">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Productos en el carro
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
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                Información del comprador
            </div>
            <div class="card-body">
                <form action="{{route('order.store')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="customer_name">Nombres Completos</label>
                        <input type="text" class="form-control @error('customer_name') is-invalid @enderror" name="customer_name" id="customer_name" aria-describedby="customer_name">
                        @error('customer_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="customer_email">Correo Electronico</label>
                        <input type="email" class="form-control @error('customer_email') is-invalid @enderror" name="customer_email" id="customer_email">
                        @error('customer_email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="customer_mobile">Número Celular</label>
                        <input type="text" class="form-control @error('customer_mobile') is-invalid @enderror" name="customer_mobile" id="customer_mobile">
                        @error('customer_mobile')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <input type="submit" class="btn btn-primary" value="Enviar">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection