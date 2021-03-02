<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $products = Product::with(['gallery'])->paginate(15);
        $categories = Category::all();

        return view('pages.category', [
            'products' => $products,
            'categories' => $categories
        ]);
    }

    public function detail(Request $request, $slug)
    {
        
        $category = Category::where('slug',$slug)->firstorfail();
        $categories = Category::all();
        $products = Product::with(['gallery'])->where('categories_id', $category->id)->paginate(15);

        return view('pages.category', [
            'products' => $products,
            'category' => $category,
            'categories' => $categories
        ]);
    }
}
