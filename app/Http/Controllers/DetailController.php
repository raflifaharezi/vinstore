<?php

namespace App\Http\Controllers;

use App\Product;
use App\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    public function index(Request $request, $id)
    {
        $products = Product::with(['gallery','user'])->where('slug', $id)->firstOrFail();
        return view('pages.detail', [
            'products' => $products
        ]);
    }
    public function add(Request $request, $id){
        $data = [
            'product_id' => $id,
            'user_id' => Auth::user()->id,
        ];

        Cart::create($data);

        return redirect()->route('cart');
    }
}
