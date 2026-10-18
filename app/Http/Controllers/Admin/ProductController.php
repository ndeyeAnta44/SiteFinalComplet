<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    public function index(){
        $products = Product::with('category')->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create(){
        $categories = Category::all();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request){
        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_url'   => 'nullable|url',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            // Upload fichier
            $imagePath = $request->file('image')->store('products', 'public');
            $imagePath = 'storage/' . $imagePath;
        } elseif ($request->filled('image_url')) {
            // URL externe
            $imagePath = $request->image_url;
        }

        Product::create([
            'name'        => $request->name,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect('/admin/products')->with('success', 'Produit ajouté avec succès !');
    }

    public function edit($id){
        $product    = Product::findOrFail($id);
        $categories = Category::all();
        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id){
        $product = Product::findOrFail($id);

        $request->validate([
            'name'        => 'required|string|max:255',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|integer|min:0',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image_url'   => 'nullable|url',
        ]);

        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            // Supprimer ancienne si stockée localement
            if ($product->image && str_starts_with($product->image, 'storage/')) {
                \Storage::disk('public')->delete(str_replace('storage/', '', $product->image));
            }
            $imagePath = 'storage/' . $request->file('image')->store('products', 'public');
        } elseif ($request->filled('image_url')) {
            $imagePath = $request->image_url;
        }

        $product->update([
            'name'        => $request->name,
            'price'       => $request->price,
            'stock'       => $request->stock,
            'category_id' => $request->category_id,
            'description' => $request->description,
            'image'       => $imagePath,
        ]);

        return redirect('/admin/products')->with('success', 'Produit modifié avec succès !');
    }

    public function destroy($id){
        $product = Product::findOrFail($id);
        if ($product->image && str_starts_with($product->image, 'storage/')) {
            \Storage::disk('public')->delete(str_replace('storage/', '', $product->image));
        }
        $product->delete();
        return redirect('/admin/products')->with('success', 'Produit supprimé.');
    }
}
