<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;

class LandingController extends Controller
{
    public function index()
    {
    $products = Product::latest()->take(8)->get();
    $stores = Store::where('is_verified', true)->take(4)->get(); // ambil 4 toko

    return view('landing.index', compact('products', 'stores'));
}
}
