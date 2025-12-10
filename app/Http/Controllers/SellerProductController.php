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
            'images.*'             => 'image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

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
                    'is_thumbnail' => $index == 0 ? 1 : 0
                ]);
            }
        }

        return redirect()->route('seller.products.index')
            ->with('success', 'Produk berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $product = Product::where('store_id', Auth::user()->store->id)
            ->with('productImages')
            ->findOrFail($id);

        $categories = ProductCategory::orderBy('name')->get();

        return view('seller.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::where('store_id', Auth::user()->store->id)->findOrFail($id);

        $request->validate([
            'name'                 => 'required|max:150',
            'price'                => 'required|numeric',
            'stock'                => 'required|numeric',
            'product_category_id'  => 'required|exists:product_categories,id',
            'condition'            => 'required',
            'description'          => 'required',
            'weight'               => 'required|numeric',
            'thumbnail'            => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048',
            'images.*'             => 'nullable|image|mimes:png,jpg,jpeg,webp|max:2048'
        ]);

        $product->update([
            'name'                 => $request->name,
            'price'                => $request->price,
            'stock'                => $request->stock,
            'product_category_id'  => $request->product_category_id,
            'condition'            => $request->condition,
            'description'          => $request->description,
            'weight'               => $request->weight
        ]);

        /** UPDATE THUMBNAIL */
        if ($request->file('thumbnail')) {
            $oldThumb = $product->productImages->where('is_thumbnail', 1)->first();
            if ($oldThumb) {
                Storage::disk('public')->delete('products/'.$oldThumb->image);

                $newThumb = $request->file('thumbnail');
                $filename = time() . '_' . $newThumb->getClientOriginalName();
                $newThumb->storeAs('products', $filename, 'public');

                $oldThumb->update(['image' => $filename]);
            }
        }

        /** UPLOAD FOTO BARU */
        if ($request->hasFile('images')) {
            foreach ($request->images as $img) {
                $filename = time() . '_' . $img->getClientOriginalName();
                $img->storeAs('products', $filename, 'public');

                ProductImage::create([
                    'product_id'   => $product->id,
                    'image'        => $filename,
                    'is_thumbnail' => 0
                ]);
            }
        }

        return redirect()->back()->with('success', 'Produk berhasil diperbarui!');
    }

    public function deleteImage($id)
    {
        $image = ProductImage::findOrFail($id);

        // hanya pemilik toko yang boleh hapus
        if ($image->product->store_id != Auth::user()->store->id) {
            abort(403);
        }

        Storage::disk('public')->delete('products/'.$image->image);
        $image->delete();

        return back()->with('success', 'Foto berhasil dihapus!');
    }

    public function destroy($id)
    {
        $product = Product::where('id', $id)
            ->where('store_id', Auth::user()->store->id)
            ->firstOrFail();

        foreach ($product->productImages as $img) {
            Storage::disk('public')->delete('products/' . $img->image);
        }

        $product->delete();

        return back()->with('success', 'Produk berhasil dihapus.');
    }
}