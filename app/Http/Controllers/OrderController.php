<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    // Afficher le formulaire de commande
    public function checkout(){
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Votre panier est vide.');
        }
        return view('checkout');
    }

    // Valider la commande
    public function placeOrder(Request $request){
        $request->validate([
            'first_name'     => 'required|string|max:100',
            'last_name'      => 'required|string|max:100',
            'email'          => 'required|email',
            'phone'          => 'required|string|max:20',
            'city'           => 'required|string',
            'address'        => 'required|string',
            'payment_method' => 'required|in:wave,orange_money,livraison',
        ]);

        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect('/cart')->with('error', 'Votre panier est vide.');
        }

        // Calculer le total
        $subtotal = collect($cart)->sum(fn($item) => $item['price'] * $item['quantity']);
        $livraison = $subtotal >= 50000 ? 0 : 2000;
        $total = $subtotal + $livraison;

        // Créer la commande
        $order = Order::create([
            'user_id'        => auth()->id(),
            'first_name'     => $request->first_name,
            'last_name'      => $request->last_name,
            'email'          => $request->email,
            'phone'          => $request->phone,
            'city'           => $request->city,
            'address'        => $request->address,
            'payment_method' => $request->payment_method,
            'total'          => $total,
            'status'         => 'pending',
        ]);

        // Créer les lignes de commande
        foreach ($cart as $id => $item) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $id,
                'quantity'   => $item['quantity'],
                'price'      => $item['price'],
            ]);
        }

        // Vider le panier
        session()->forget('cart');

        return view('order_success', compact('order'));
    }

    // Mes commandes (client)
    public function myOrders(){
        $orders = Order::where('user_id', auth()->id())->latest()->get();
        return view('orders', compact('orders'));
    }

    // Détail commande (client)
    public function show($id){
        $order = Order::with('items.product')->findOrFail($id);
        // Vérifier que c'est bien la commande de l'utilisateur connecté (ou admin)
        if (auth()->user()->role !== 'admin' && $order->user_id !== auth()->id()) {
            abort(403);
        }
        return view('order_detail', compact('order'));
    }

    // ADMIN : toutes les commandes
    public function adminIndex(){
        $orders = Order::with('user')->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    // ADMIN : changer statut
    public function updateStatus(Request $request, $id){
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        return back()->with('success', 'Statut mis à jour.');
    }
}
