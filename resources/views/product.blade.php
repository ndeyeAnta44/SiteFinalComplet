@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="mb-3">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="/" class="text-orange">Accueil</a></li>
        <li class="breadcrumb-item"><a href="/shop" class="text-orange">Boutique</a></li>
        <li class="breadcrumb-item active">{{ $product->name }}</li>
    </ol>
</nav>

<div class="row g-4">
    <div class="col-md-5">
        <div class="card shadow-sm p-2">
            <img src="{{ $product->image ?  $product->image_src : 'https://via.placeholder.com/500x400?text='.urlencode($product->name) }}"
                 class="img-fluid rounded" style="max-height:400px; object-fit:cover; width:100%;" alt="{{ $product->name }}">
        </div>
    </div>

    <div class="col-md-7">
        <span class="badge-cat mb-2 d-inline-block">{{ $product->category->name ?? 'Non catégorisé' }}</span>
        <h2 class="fw-bold">{{ $product->name }}</h2>
        <h3 class="text-orange fw-bold">{{ number_format($product->price, 0, ',', ' ') }} FCFA</h3>

        <p class="text-muted mt-3">{{ $product->description }}</p>

        <div class="d-flex align-items-center gap-2 mb-3">
            @if($product->stock > 0)
                <span class="badge bg-success"><i class="bi bi-check-circle me-1"></i>En stock ({{ $product->stock }})</span>
            @else
                <span class="badge bg-danger"><i class="bi bi-x-circle me-1"></i>Épuisé</span>
            @endif
        </div>

        <hr>

        @if($product->stock > 0)
            <a href="/add-to-cart/{{ $product->id }}" class="btn btn-orange btn-lg me-2">
                <i class="bi bi-cart-plus me-2"></i>Ajouter au panier
            </a>
        @else
            <button class="btn btn-secondary btn-lg me-2" disabled>Produit épuisé</button>
        @endif
        <a href="/shop" class="btn btn-outline-secondary btn-lg">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>

        <div class="mt-4 p-3 bg-white rounded shadow-sm small text-muted">
            <i class="bi bi-truck text-orange me-2"></i> Livraison sous 48h à Dakar<br>
            <i class="bi bi-shield-check text-orange me-2"></i> Produit garanti<br>
            <i class="bi bi-arrow-counterclockwise text-orange me-2"></i> Retour sous 7 jours
        </div>
    </div>
</div>
@endsection
