<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Homepage
    public function index()
    {
        $products = Product::with('store', 'category')->get();
        return view('products.index', compact('products'));
    }

    // Detail Produk
    public function show($slug)
    {
        $product = Product::with('store', 'category')->where('slug', $slug)->firstOrFail();
        return view('products.show', compact('product'));
    }
}
