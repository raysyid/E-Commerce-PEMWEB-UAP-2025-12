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
        
        // Get other products from the same store (exclude current product)
        $relatedProducts = Product::with('productImages')
            ->where('store_id', $product->store_id)
            ->where('id', '!=', $product->id)
            ->where('stock', '>', 0)
            ->inRandomOrder()
            ->limit(5)
            ->get();
        
        return view('products.show', compact('product', 'relatedProducts'));
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

    // Newest Products
    public function newest()
    {
        $products = Product::with(['productCategory', 'store', 'productImages'])
            ->where('stock', '>', 0)
            ->latest()
            ->take(16)
            ->get();

        return view('products.newest', compact('products'));
    }
}