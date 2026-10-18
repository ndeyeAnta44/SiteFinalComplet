@extends('layouts.app')
@section('content')
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/" class="text-orange">Accueil</a></li>
        <li class="breadcrumb-item"><a href="/orders" class="text-orange">Mes commandes</a></li>
        <li class="breadcrumb-item active">Commande #{{ $order->id }}</li>
    </ol>
</nav>

<div class="row g-4">
    <div class="col-md-7">
        <div class="card shadow-sm p-4">
            <h5 class="fw-bold border-bottom pb-2 mb-3">
                <i class="bi bi-box me-2 text-orange"></i>Commande #{{ $order->id }}
                @php
                    $colors = ['pending'=>'warning text-dark','confirmed'=>'success','shipped'=>'primary','delivered'=>'dark','cancelled'=>'danger'];
                    $labels = ['pending'=>'En attente','confirmed'=>'Confirmée','shipped'=>'Expédiée','delivered'=>'Livrée','cancelled'=>'Annulée'];
                @endphp
                <span class="badge bg-{{ $colors[$order->status] ?? 'secondary' }} ms-2">{{ $labels[$order->status] ?? $order->status }}</span>
            </h5>

            <table class="table table-sm">
                <thead class="bg-light">
                    <tr><th>Produit</th><th>Prix unitaire</th><th>Qté</th><th>Total</th></tr>
                </thead>
                <tbody>
                    @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product->name ?? 'Produit supprimé' }}</td>
                        <td>{{ number_format($item->price, 0, ',', ' ') }} FCFA</td>
                        <td>{{ $item->quantity }}</td>
                        <td class="fw-bold">{{ number_format($item->price * $item->quantity, 0, ',', ' ') }} FCFA</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-end">
                <div class="text-end">
                    <p class="mb-1 text-muted small">Livraison : {{ $order->total > 50000 ? 'Gratuite' : '2 000 FCFA' }}</p>
                    <h5 class="fw-bold text-orange">Total : {{ number_format($order->total, 0, ',', ' ') }} FCFA</h5>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="card shadow-sm p-4">
            <h6 class="fw-bold border-bottom pb-2 mb-3">Informations de livraison</h6>
            <p class="mb-1"><strong>Nom :</strong> {{ $order->first_name }} {{ $order->last_name }}</p>
            <p class="mb-1"><strong>Email :</strong> {{ $order->email }}</p>
            <p class="mb-1"><strong>Téléphone :</strong> {{ $order->phone }}</p>
            <p class="mb-1"><strong>Ville :</strong> {{ $order->city }}</p>
            <p class="mb-1"><strong>Adresse :</strong> {{ $order->address }}</p>
            <p class="mb-1"><strong>Paiement :</strong>
                {{ $order->payment_method == 'wave' ? 'Wave' : ($order->payment_method == 'orange_money' ? 'Orange Money' : 'À la livraison') }}
            </p>
            <p class="mb-0 text-muted small">Commandé le {{ $order->created_at->format('d/m/Y à H:i') }}</p>
        </div>

        <a href="/orders" class="btn btn-outline-secondary w-100 mt-3">
            <i class="bi bi-arrow-left me-1"></i>Retour à mes commandes
        </a>
    </div>
</div>
@endsection
