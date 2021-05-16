<!-- Stored in resources/views/child.blade.php -->

@extends('layout.app')

@section('content')
    <div class="row">
        @foreach($products as $product)
        <div class="col-sm-6 col-lg-4">
            <div class="card">
                <img src="{{asset($product->image)}}" class="card-img-top" alt="...">
                <div class="card-body">
                    <div class="form-group">
                        <label for="name"><b>Nombre</b></label><br/>
                        {{$product->name}}
                    </div>
                    <div class="form-group">
                        <label for="price"><b>Precio</b></label><br/>
                        ${{number_format($product->price)}}
                    </div>
                    <div class="form-group">
                        <a href="{{route('buy', ['id' => $product->id])}}" class="btn btn-info">Comprar</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
@endsection