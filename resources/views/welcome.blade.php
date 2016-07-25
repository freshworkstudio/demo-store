@extends('layouts.app')

@section('content')
<img src="https://placehold.it/1920x540" alt="Banner 1" style="margin-top: -20px" />
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Productos</h2>
            @include('flash::message')
            <div class="row products">
                @foreach($products as $product)
                    <div class="col-md-3 product">
                        <div class="img">
                            <img src="{{ $product->image}}" alt="{{ $product->name }}" />
                            <span class="name">{{ $product->name }}</span>
                        </div>
                        <span class="price">$ {{ price($product->price) }}</span>
                        <a href="{{ route('cart.add', $product->id) }}" class="btn btn-success"><i class="fa fa-shopping-cart"></i> Agregar</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
