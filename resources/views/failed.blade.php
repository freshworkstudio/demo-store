@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>No pudimos completar tu orden</h2>
            <h4>Transacción rechazada</h4>
            @include('flash::message')
            <div class="row">
                <div class="col-md-6">

                    <table class="table">
                        <tr>
                            <th>ID</th>
                            <td>{{ $transaction->id }}</td>
                        </tr>
                        <tr>
                            <th>Orden de compra</th>
                            <td>{{ $transaction->buyOrder }}</td>
                        </tr>
                    </table>

                    <h4>Productos en el carrito</h4>
                    <table class="table table-striped">
                        <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td class="name">{{ $product->name }}</td>
                                <td class="price">{{ $product->pivot->qty }}</td>
                                <td class="price">$ {{ price($product->price) }}</td>
                                <td class="price">$ {{ price($product->price*$product->pivot->qty) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-right">TOTAL</td>
                            <td>$ {{ price($transaction->amount) }}</td>
                        </tr>
                    </table>
                    <a class="btn btn-success pull-right" href="{{ route('checkout.process') }}">Volver a intentar <i class="fa fa-refresh"></i></a>
                    <a class="btn pull-right" href="{{ route('cart') }}"><i class="fa fa-arrow-left"></i> Volver</a>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
