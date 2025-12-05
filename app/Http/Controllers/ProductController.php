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
}
