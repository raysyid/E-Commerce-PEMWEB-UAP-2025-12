<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Store;

class LandingController extends Controller
{
    public function index()
    {
        $search = request('search');

        // Build product query
        $productsQuery = Product::where('stock', '>', 0);

        // If search query exists, filter by product name OR category name
        if ($search) {
            $productsQuery->where(function($query) use ($search) {
                $query->where('name', 'LIKE', '%' . $search . '%')
                      ->orWhereHas('category', function($q) use ($search) {
                          $q->where('name', 'LIKE', '%' . $search . '%');
                      });
            });
        }

        // Get products
        if ($search) {
            $products = $productsQuery->with('productImages', 'category')->paginate(12);
        } else {
            $products = $productsQuery->latest()->take(8)->get();
        }

        $stores = Store::where('is_verified', true)->take(4)->get();

        return view('landing.index', compact('products', 'stores', 'search'));
    }
}
