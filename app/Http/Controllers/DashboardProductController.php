<?php

namespace App\Http\Controllers;

use App\Product;
use App\Category;
use App\Http\Requests\Admin\ProductRequest;
use App\ProductGallery;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class DashboardProductController extends Controller
{
    public function product()
    {
        $products = Product::with('gallery', 'category')
                            ->where('user_id', Auth::user()->id)
                            ->get();

        return view('pages-dashboard.dashboard-product', [
            'products' => $products
        ]); 
    }

    public function create_product()
    {
        $categories = Category::all();
        return view('pages-dashboard.dashboard-product-create',[
            'categories' => $categories
        ]); 
    }

    public function store(ProductRequest $request)
    {
        //memanggil validasi
        $data = $request->all();

        $data['slug'] = Str::slug($request->name);
        $product =Product::create($data);

        $gallery = [
            'product_id' => $product->id,
            'photo' => $request->file('photo')->store('assets/product', 'public') 
        ];
        
        ProductGallery::create($gallery);

        return redirect()->route('dashboard-product');
    
    }
}
