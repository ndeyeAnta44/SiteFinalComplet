<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class HomeController extends Controller
{
    public function index(){
        $products = Product::with('category')->latest()->take(8)->get();
        return view('layouts.home', compact('products'));
    }
}
