<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class CartController extends Controller
{
    public function index(){
        $cart = session()->get('cart', []);
        return view('cart', compact('cart'));
    }

    public function add($id){
        $product = Product::findOrFail($id);

        if ($product->stock <= 0) {
            return redirect()->back()->with('error', 'Ce produit est épuisé.');
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            $cart[$id] = [
                'name'     => $product->name,
                'quantity' => 1,
                'price'    => $product->price,
                'image'    => $product->image,
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'Produit ajouté au panier !');
    }

    public function update(Request $request){
        $cart = session()->get('cart', []);

        if ($request->quantities) {
            foreach ($request->quantities as $id => $qty) {
                if (isset($cart[$id])) {
                    if ($qty <= 0) {
                        unset($cart[$id]);
                    } else {
                        $cart[$id]['quantity'] = (int)$qty;
                    }
                }
            }
        }

        session()->put('cart', $cart);
        return redirect('/cart')->with('success', 'Panier mis à jour.');
    }

    public function remove($id){
        $cart = session()->get('cart', []);
        unset($cart[$id]);
        session()->put('cart', $cart);
        return redirect('/cart')->with('success', 'Produit retiré du panier.');
    }

    public function clear(){
        session()->forget('cart');
        return redirect('/cart');
    }
}
