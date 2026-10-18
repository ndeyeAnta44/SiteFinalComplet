@extends('layouts.app')

@section('content')

<div class="row">
    <!-- SIDEBAR FILTRES -->
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm p-3">
            <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="bi bi-funnel me-2 text-orange"></i>Catégories</h6>
            <a href="/shop" class="d-block text-decoration-none mb-2 text-dark fw-bold">
                <i class="bi bi-grid me-1"></i> Tous les produits
            </a>
            @php $sideCategories = \App\Models\Category::all(); @endphp
            @foreach($sideCategories as $cat)
                <a href="/category/{{ $cat->id }}" class="d-block text-decoration-none mb-2 text-secondary footer-link">
                    <i class="bi bi-chevron-right me-1"></i>{{ $cat->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- PRODUITS -->
    <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">
                <i class="bi bi-grid me-2 text-orange"></i>
                @isset($categoryName) {{ $categoryName }} @else Tous les produits @endisset
            </h4>
            <span class="text-muted small">{{ count($products) }} produit(s)</span>
        </div>

        <div class="row g-3">
            @forelse($products as $product)
            <div class="col-6 col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="position-relative">
                        <img src="{{ $product->image ? $product->image_src : 'https://via.placeholder.com/300x200?text='.urlencode($product->name) }}"
                             class="card-img-top" style="height:190px; object-fit:cover;" alt="{{ $product->name }}">
                        @if($product->stock <= 0)
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">Épuisé</span>
                        @elseif($product->stock <= 5)
                            <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">Stock limité</span>
                        @endif
                    </div>
                    <div class="card-body p-2">
                        <span class="badge-cat">{{ $product->category->name ?? '' }}</span>
                        <h6 class="card-title mt-1 mb-1">{{ $product->name }}</h6>
                        <p class="text-muted small mb-1" style="font-size:12px;">
                            {{ Str::limit($product->description, 50) }}
                        </p>
                        <strong class="text-orange">{{ number_format($product->price, 0, ',', ' ') }} FCFA</strong>
                    </div>
                    <div class="card-footer p-2 bg-white border-0">
                        <div class="d-flex gap-1">
                            <a href="/product/{{ $product->id }}" class="btn btn-outline-secondary btn-sm flex-fill">
                                <i class="bi bi-eye"></i>
                            </a>
                            @if($product->stock > 0)
                                <a href="/add-to-cart/{{ $product->id }}" class="btn btn-orange btn-sm flex-fill">
                                    <i class="bi bi-cart-plus"></i> Ajouter
                                </a>
                            @else
                                <button class="btn btn-secondary btn-sm flex-fill" disabled>Épuisé</button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-box-seam fs-1 d-block mb-3"></i>
                    <p>Aucun produit disponible dans cette catégorie.</p>
                    <a href="/shop" class="btn btn-orange">Voir tous les produits</a>
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
