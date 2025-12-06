<?php

namespace App\Http\Controllers;

use App\Models\Product;

class LandingController extends Controller
{
    public function index()
    {
        $products = Product::with('productImages')->inRandomOrder()->take(8)->get();
        return view('landing.index', compact('products'));
    }
}
