@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Gracias por tu compra</h2>
            <h4>Transacción aprobada</h4>
            @include('flash::message')
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-responsive table-bordered">
                        <tr>
                            <th>ID</th>
                            <td>{{ $transaction->id }}</td>
                        </tr>
                        <tr>
                            <th>Orden de compra</th>
                            <td>{{ $transaction->buyOrder }}</td>
                        </tr>
                        <tr>
                            <th>Monto</th>
                            <td>$ {{ price($transaction->amount) }} CLP</td>
                        </tr>
                        <tr>
                            <th>Código de autorización</th>
                            <td>{{ $transaction->oneclick_response->authorizationCode }}</td>
                        </tr>
                        <tr>
                            <th>Tarjeta</th>
                            <td>xxxx - xxxx - xxxx - {{ $transaction->oneclick_response->last4CardDigits }}</td>
                        </tr>
                        <tr>
                            <th>Tipo de pago</th>
                            <td>Crédito sin cuotas</td>
                        </tr>
                    </table>

                    <h4>Productos comprados</h4>
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
                </div>
            </div>

            <a href="{{ url('/') }}" class="btn"><i class="fa fa-arrow-left"></i> Volver al inicio</a>
        </div>
    </div>
</div>
@endsection
