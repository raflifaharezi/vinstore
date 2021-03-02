<?php

namespace App\Http\Controllers;
use App\Cart;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        //with= ['product.gallery'] relasi dari model product dan
        // relasi ke galery yang relasiny dibuat di model product
        //Auth::user yaitu memunculkan carts disaat user sudah login
        $carts= Cart::with(['product.gallery', 'user'])
                            ->where('user_id', Auth::user()->id)
                                    ->get();
        return view('pages.cart', [
            'carts' => $carts
        ]);
    }

    public function delete(Request $request, $id){
        $cart = Cart::findOrfail($id);

        $cart->delete();
        return redirect()->route('cart');

    }

    public function success()
    {
        return view('pages.success');
    }
}
