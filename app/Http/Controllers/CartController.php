<?php

namespace App\Http\Controllers;

use App\Product;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;

class CartController extends Controller
{
    /**
     * @var Cart
     */
    private $cart;

    /**
     * CartController constructor.
     */
    public function __construct(Cart $cart)
    {
        $this->cart = $cart;
    }

    public function index()
    {
        $products = $this->cart->content();

        return view('cart', compact('products'));
    }
    public function add(Request $request, Product $product, $qty = 1)
    {
        $this->cart->add($product, $qty, []);

        flash()->success($product->name . ' (' . $qty . ') agregado al carrito. <a href="' . route('cart') . '">Ver carro</a>');

        return redirect()->back();
    }

    public function empty()
    {
        $this->cart->destroy();
        flash()->success('Carro de compras vaciado satisfactoriamente');
        return redirect()->back();
    }
}
