<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class StoreController extends Controller
{
    public function shop(Request $request){
        $query = Product::with('category');

        // Recherche
        if ($request->has('q') && $request->q) {
            $query->where('name', 'like', '%'.$request->q.'%')
                  ->orWhere('description', 'like', '%'.$request->q.'%');
        }

        $products = $query->latest()->get();
        return view('shop', compact('products'));
    }

    public function byCategory($id){
        $category = Category::findOrFail($id);
        $products = Product::with('category')->where('category_id', $id)->get();
        $categoryName = $category->name;
        return view('shop', compact('products', 'categoryName'));
    }
}
