<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SellerCategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::orderBy('created_at', 'desc')->get();
        return view('seller.categories', compact('categories')); // ✔️ bukan seller.categories.index
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100|unique:product_categories,name'
        ]);

        ProductCategory::create([
            'name' => $request->name,
            'slug' => strtolower(str_replace(' ', '-', $request->name)),
            'description' => $request->description
        ]);

        return redirect()->route('seller.categories.index')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        return view('seller.categories-edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100|unique:product_categories,name,' . $id,
        ]);

        $category = ProductCategory::findOrFail($id);
        $category->update([
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect()->route('seller.categories.index')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy($id)
    {
        ProductCategory::findOrFail($id)->delete();

        return redirect()->route('seller.categories.index')
            ->with('success', 'Kategori berhasil dihapus');
    }
}
