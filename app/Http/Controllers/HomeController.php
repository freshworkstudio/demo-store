<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

use App\Http\Requests;

class HomeController extends Controller
{
    public function home(Product $product)
    {
        $products = $product->all();
        return view('welcome', compact('products'));
    }
}
