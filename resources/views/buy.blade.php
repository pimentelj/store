<!-- Stored in resources/views/child.blade.php -->

@extends('layout.app')

@section('content')
<div class="row">
    <div class="col-sm-8 col-lg-9">
        <div class="row">
            <div class="col-12">
                <h5 class="text-center">Producto agregado al carro</h5>
            </div>
        </div>
        <div class="row mt-3">
            <div class="card">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="{{asset($product->image)}}" class="card-img-top" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="name"><b>Nombre</b></label><br/>
                                {{$product->name}}
                            </div>
                            <div class="form-group">
                                <label for="price"><b>Precio</b></label><br/>
                                ${{number_format($product->price)}}                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5 mx-md-n5">
            <div class="col px-md-5 text-center">
                <a href="{{route('catalog')}}" class="btn btn-primary btn-lg w-50">Ir al catálogo</a>
            </div>
            <div class="col px-md-5 text-center">
                <a href="{{route('catalog')}}" class="btn btn-secondary btn-lg w-50">Pagar</a>
            </div>
        </div>
    </div>
    <div class="col-sm-4 col-lg-3 mt-5">
        <div class="card text-white bg-secondary mb-3">
            <div class="card-header"><i class="fa fa-shopping-cart" aria-hidden="true"></i> Productos en el carro</div>
            <div class="card-body">
                @php
                $total = 0;
                @endphp
                <ul class="list-group" style="overflow-y: scroll; height: 300px;">
                    @foreach($products as $product)
                    @php
                    $product = \App\Product::find($product);
                    $total += $product->price;
                    @endphp
                    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-secondary">
                      {{$product->name}}
                      <span class="badge badge-primary badge-pill">${{number_format($product->price)}}</span>
                    </li>
                    @endforeach
                </ul>
                <ul class="list-group mt-1">
                    <li class="list-group-item d-flex justify-content-between align-items-center list-group-item-secondary">
                      Total
                      <span class="badge badge-primary badge-pill">${{number_format($total)}}</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection