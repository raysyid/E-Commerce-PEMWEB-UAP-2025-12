<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerCategoryController extends Controller
{
    /**
     * Display all available categories (read-only)
     */
    public function index()
    {
        $storeId = Auth::user()->store->id;
        
        $categories = ProductCategory::withCount(['products' => function ($query) use ($storeId) {
                $query->where('store_id', $storeId)
                      ->where('stock', '>', 0); // Only count in-stock products
            }])
            ->orderBy('name', 'asc')
            ->get();
        
        return view('seller.categories', compact('categories'));
    }
}
