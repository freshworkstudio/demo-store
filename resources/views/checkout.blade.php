@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h2>Confirmación de compra</h2>
            @include('flash::message')
            <div class="row">
                <div class="col-md-12">
                    <table class="table">
                        <tr>
                            <th>Nombre</th>
                            <th>Cantidad</th>
                            <th>Precio</th>
                            <th>Subtotal</th>
                        </tr>
                        @foreach($products as $product)
                            <tr>
                                <td class="name">{{ $product->name }}</td>
                                <td class="price">{{ $product->qty }}</td>
                                <td class="price">$ {{ price($product->price) }}</td>
                                <td class="price">$ {{ price($product->subtotal) }}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="3" class="text-right">TOTAL</td>
                            <td>$ {{ $total }}</td>
                        </tr>
                    </table>
                </div>

            </div>
            <div class="pull-right col-md-4">
                @if(Auth::user()->hasAuthorizedCreditCard())
                    <a class="btn btn-success pull-right" href="{{ route('checkout.process') }}"> Pagar con Webpay OneClick ( <i class="fa fa-credit-card"></i> - {{ Auth::user()->cc_final_numbers }} )</a>
                    <a class="pull-right btn" href="{{route('checkout.deletecc')}}" style="color: red"><i class="fa fa-close"></i> Eliminar mi tarjeta</a>
                @else
                    <a class="btn btn-success pull-right" href="{{ route('checkout.authorize') }}"><i class="fa fa-credit-card"></i> Agregar tarjeta a mi cuenta</a>
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <img src="{{ asset('images/oneclick.png') }}" alt="Webpay OneClick" class="pull-right" style="padding-top: 20px" width="150" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
