<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Homepage
    public function index()
    {
        $products = Product::with('store', 'productCategory')->get();
        return view('products.index', compact('products'));
    }

    // Detail Produk
    public function show($slug)
    {
        $product = Product::with('store', 'productCategory')->where('slug', $slug)->firstOrFail();
        return view('products.show', compact('product'));
    }

    // Browse by Category
    public function category($slug)
    {
        $category = \App\Models\ProductCategory::where('slug', $slug)->firstOrFail();
        
        $products = Product::with(['productCategory', 'store', 'productImages'])
            ->where('product_category_id', $category->id)
            ->where('stock', '>', 0)
            ->latest()
            ->paginate(12);

        return view('category.browse', compact('category', 'products'));
    }
}
