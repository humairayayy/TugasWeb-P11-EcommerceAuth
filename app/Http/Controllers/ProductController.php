<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'user'])->latest()->paginate(10);

        return view('products.index', compact('products'));
    }

    public function create()
    {
        Gate::authorize('create', Product::class);

        return view('products.create', ['categories' => Category::all()]);
    }

    public function store(Request $request)
    {
        Gate::authorize('create', Product::class);

        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        $data['slug'] = Str::slug($data['name']) . '-' . Str::random(5);
        $request->user()->products()->create($data);

        return redirect()->route('products.index')->with('status', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        Gate::authorize('update', $product);

        return view('products.edit', [
            'product'    => $product,
            'categories' => Category::all(),
        ]);
    }

    public function update(Request $request, Product $product)
    {
        Gate::authorize('update', $product);

        $data = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
        ]);

        $product->update($data);

        return redirect()->route('products.index')->with('status', 'Produk berhasil diperbarui.');
    }

    public function destroy(Product $product)
    {
        Gate::authorize('delete', $product);

        $product->delete();

        return redirect()->route('products.index')->with('status', 'Produk berhasil dihapus.');
    }
}