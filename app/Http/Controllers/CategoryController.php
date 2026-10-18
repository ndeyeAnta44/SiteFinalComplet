<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::withCount('products')->get();
        return view('admin.categories', compact('categories'));
    }

    public function store(Request $request){
        $request->validate(['name' => 'required|string|max:100|unique:categories,name']);
        Category::create(['name' => $request->name]);
        return back()->with('success', 'Catégorie ajoutée.');
    }

    public function update(Request $request, $id){
        $request->validate(['name' => 'required|string|max:100']);
        Category::findOrFail($id)->update(['name' => $request->name]);
        return back()->with('success', 'Catégorie modifiée.');
    }

    public function destroy($id){
        Category::findOrFail($id)->delete();
        return back()->with('success', 'Catégorie supprimée.');
    }
}
