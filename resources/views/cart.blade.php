@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Carro de compras</h2>
            @include('flash::message')
            <div class="row">
                @foreach($products as $product)
                    <div class="col-md-3">
                        <div class="img">
                            <img src="{{ $product->model->image}}" alt="{{ $product->name }}" />
                        </div>
                        <span class="name">{{ $product->name }} ({{ $product->qty }}x)</span>
                        <span class="price" style="display: block; font-size: 16px">$ {{ price($product->price) }}</span>

                    </div>
                @endforeach
            </div>
            <a class="btn btn-success pull-right" href="{{ route('checkout') }}">Continuar <i class="fa fa-arrow-right"></i></a>
            <a class="btn pull-right" href="{{ route('cart.empty') }}">Vaciar carro</a>

        </div>
    </div>
</div>
@endsection
