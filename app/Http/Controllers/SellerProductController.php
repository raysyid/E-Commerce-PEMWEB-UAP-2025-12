<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class SellerProductController extends Controller
{
    public function index()
    {
        $products = Product::where('store_id', Auth::user()->store->id)
            ->with('productCategory', 'productImages')
            ->latest()
            ->get();

        return view('seller.products', compact('products'));
    }

    public function create()
    {
        $categories = ProductCategory::orderBy('name')->get();

        return view('seller.product-create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'                 => 'required|max:150',
            'price'                => 'required|numeric',
            'stock'                => 'required|numeric',
            'product_category_id'  => 'required|exists:product_categories,id',
            'condition'            => 'required',
            'description'          => 'required',
            'weight'               => 'required|numeric',
            'images.*'             => 'image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // generate slug unik
        $slug = Str::slug($request->name);
        if (Product::where('slug', $slug)->exists()) {
            $slug .= '-' . time();
        }

        $product = Product::create([
            'store_id'             => Auth::user()->store->id,
            'product_category_id'  => $request->product_category_id,
            'name'                 => $request->name,
            'price'                => $request->price,
            'slug'                 => $slug,
            'stock'                => $request->stock,
            'condition'            => $request->condition,
            'description'          => $request->description,
            'weight'               => $request->weight
        ]);

        // SIMPAN GAMBAR
        if ($request->hasFile('images')) {
            foreach ($request->images as $index => $file) {
                $filename = time() . '_' . $file->getClientOriginalName();
                $file->storeAs('products', $filename, 'public');

                ProductImage::create([
                    'product_id'   => $product->id,
                    'image'        => $filename,
                    'is_thumbnail' => $index == 0 ? 1 : 0, // foto pertama jadi thumbnail
                ]);
            }
        }

        return redirect()
            ->route('seller.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)
            ->where('store_id', Auth::user()->store->id)
            ->firstOrFail();

        // HAPUS FOTO DI STORAGE
        foreach ($product->productImages as $img) {
            if (Storage::exists('public/products/' . $img->image)) {
                Storage::delete('public/products/' . $img->image);
            }
        }
        $product->delete();
        return back()->with('success', 'Produk berhasil dihapus.');
    }
}