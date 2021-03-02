<?php

namespace App\Http\Controllers;

use App\Category;
use App\Product;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    /*public function __construct()
    {
        $this->middleware('auth');
    }
    */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $products = Product::with(['gallery'])->take(8)->get();
        $categories = Category::take(6)->get();
        return view('pages.home', [
            'products' => $products,
            'categories' => $categories
            ]);
    }

    
}
