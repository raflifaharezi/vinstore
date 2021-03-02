<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Str;
use App\Category;
use App\Http\Requests\Admin\ProductRequest;
use App\ProductGallery;
use Illuminate\Http\Request;

class DashboardDetailController extends Controller
{
    public function detail_product(Request $request, $id)
    {
        $products = Product::with(['gallery', 'category','user'])->findOrFail($id);
        $categories = Category::all();

        return view('pages-dashboard.dashboard-product-detail', [
            'products' => $products,
            'categories' => $categories
        ]); 
    }

    public function uploadGallery(Request $request)
    {
        $data = $request->all();
        $data['photo'] = $request->file('photo')->store('assets/product', 'public');

        ProductGallery::create($data);
        return redirect()->route('detail-products', $request->product_id);
    }

    public function deleteGallery(Request $request, $id)
    {
        $item = ProductGallery::findorfail($id);
        $item->delete($id);

        return redirect()->route('detail-products', $item->product_id);
    }

    public function updateGallery(ProductRequest $request, $id)
    {
        $data = $request->all();
        $item = Product::findorfail($id);
        $data['slug'] = Str::slug($request->name);
        $item->update($data);

        return redirect()->route('dashboard-product');
        
    }
}
