<?php

namespace App\Http\Controllers;

use App\Models\Product;

class LandingController extends Controller
{
    public function index()
    {
        // ambil 6 produk acak untuk rekomendasi
        $products = Product::inRandomOrder()->limit(6)->get();

        return view('landing.index', compact('products'));
    }
}