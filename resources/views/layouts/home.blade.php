@extends('layouts.app')

@section('content')

<!-- ===== HERO : Boutique quincaillerie ===== -->
<div class="hero-section mb-5">
    <div class="hero-content text-white text-center px-3">
        <div class="hero-badge mb-3">
            <i class="bi bi-tools me-2"></i>Quincaillerie Professionnelle — Dakar
        </div>
        <h1 class="hero-title">Tous vos outils et<br><span class="text-orange-light">matériaux au même endroit</span></h1>
        <p class="hero-subtitle">Outillage professionnel, matériaux de construction, plomberie, électricité</p>
        <div class="d-flex gap-3 justify-content-center flex-wrap mt-4">
            <a href="/shop" class="btn btn-orange btn-lg px-5 fw-bold shadow">
                <i class="bi bi-grid me-2"></i>Voir la boutique
            </a>
            <a href="/category/7" class="btn btn-outline-light btn-lg px-4 fw-bold">
                <i class="bi bi-bricks me-2"></i>Matériaux
            </a>
        </div>
        <div class="hero-stats mt-5 d-flex justify-content-center gap-5 flex-wrap">
            <div><div class="hero-stat-number">60+</div><div class="hero-stat-label">Produits</div></div>
            <div class="hero-stat-divider d-none d-md-block"></div>
            <div><div class="hero-stat-number">10</div><div class="hero-stat-label">Catégories</div></div>
            <div class="hero-stat-divider d-none d-md-block"></div>
            <div><div class="hero-stat-number">48h</div><div class="hero-stat-label">Livraison</div></div>
            <div class="hero-stat-divider d-none d-md-block"></div>
            <div><div class="hero-stat-number">100%</div><div class="hero-stat-label">Garanti</div></div>
        </div>
    </div>
</div>

<!-- ===== AVANTAGES ===== -->
<div class="row g-3 mb-5">
    @foreach([
        ['bi-truck','Livraison rapide','48h à Dakar'],
        ['bi-shield-check','Produits garantis','Qualité certifiée'],
        ['bi-headset','Support 6j/7','+221 77 000 00 00'],
        ['bi-arrow-counterclockwise','Retour 7 jours','Satisfait ou remboursé'],
    ] as $av)
    <div class="col-6 col-md-3">
        <div class="avantage-card text-center p-3 h-100">
            <i class="bi {{ $av[0] }} fs-2 text-orange mb-2 d-block"></i>
            <strong class="d-block small">{{ $av[1] }}</strong>
            <span class="text-muted" style="font-size:12px;">{{ $av[2] }}</span>
        </div>
    </div>
    @endforeach
</div>

<!-- ===== CATÉGORIES ===== -->
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0"><i class="bi bi-grid-3x3-gap me-2 text-orange"></i>Nos catégories</h4>
            <small class="text-muted">Trouvez rapidement ce qu'il vous faut</small>
        </div>
        <a href="/shop" class="btn btn-outline-secondary btn-sm">Tout voir</a>
    </div>
    @php
        $catIcons = [
            'Outillage à main'          => 'bi-hammer',
            'Outillage électrique'      => 'bi-lightning-charge',
            'Électricité'               => 'bi-plug',
            'Plomberie'                 => 'bi-droplet',
            'Visserie & Fixation'       => 'bi-gear',
            'Peinture & Décoration'     => 'bi-brush',
            'Matériaux de construction' => 'bi-bricks',
            'Soudure & Métallurgie'     => 'bi-fire',
            'Sécurité & EPI'            => 'bi-shield',
            'Jardinage & Extérieur'     => 'bi-tree',
        ];
        $catColors = ['#ff6a00','#2193b0','#11998e','#8e44ad','#e74c3c','#f39c12','#c0392b','#2c3e50','#27ae60','#16a085'];
    @endphp
    <div class="row g-3">
        @foreach($categories as $i => $cat)
        <div class="col-6 col-md-3 col-lg-2">
            <a href="/category/{{ $cat->id }}" class="text-decoration-none">
                <div class="cat-card text-center p-3 h-100">
                    <div class="cat-icon mb-2" style="color:{{ $catColors[$i % count($catColors)] }};">
                        <i class="bi {{ $catIcons[$cat->name] ?? 'bi-box' }} fs-2"></i>
                    </div>
                    <p class="fw-semibold mb-0 small">{{ $cat->name }}</p>
                </div>
            </a>
        </div>
        @endforeach
    </div>
</section>

<!-- ===== PRODUITS POPULAIRES ===== -->
<section class="mb-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0"><i class="bi bi-star me-2 text-orange"></i>Produits populaires</h4>
            <small class="text-muted">Les plus demandés par nos clients</small>
        </div>
        <a href="/shop" class="btn btn-orange btn-sm px-3">Voir tout <i class="bi bi-arrow-right ms-1"></i></a>
    </div>
    <div class="row g-3">
        @foreach($products as $product)
        <div class="col-6 col-md-3">
            <div class="card product-card shadow-sm h-100">
                <div class="position-relative overflow-hidden" style="height:200px; background:#f8f9fa;">
                    <img src="{{ $product->image_src }}"
                         class="w-100 h-100"
                         style="object-fit:contain; padding:10px; transition:0.4s;"
                         alt="{{ $product->name }}"
                         onerror="this.onerror=null; this.src='https://placehold.co/400x300/f8f9fa/ff6a00?text={{ urlencode($product->name) }}'">
                    @if($product->stock <= 0)
                        <span class="badge bg-danger position-absolute top-0 end-0 m-2">Épuisé</span>
                    @elseif($product->stock <= 5)
                        <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">Stock limité</span>
                    @endif
                    <div class="product-overlay">
                        <a href="/product/{{ $product->id }}" class="btn btn-light btn-sm rounded-pill">
                            <i class="bi bi-eye me-1"></i>Aperçu
                        </a>
                    </div>
                </div>
                <div class="card-body p-3">
                    <span class="badge-cat">{{ $product->category->name ?? '' }}</span>
                    <h6 class="card-title mt-1 mb-1 fw-semibold" style="font-size:14px; line-height:1.3;">
                        {{ $product->name }}
                    </h6>
                    <div class="d-flex align-items-center justify-content-between mt-2">
                        <strong class="text-orange">{{ number_format($product->price, 0, ',', ' ') }} F</strong>
                        @if($product->stock > 0)
                            <a href="/add-to-cart/{{ $product->id }}" class="btn btn-orange btn-sm rounded-pill px-3">
                                <i class="bi bi-cart-plus"></i>
                            </a>
                        @else
                            <button class="btn btn-secondary btn-sm rounded-pill px-3" disabled><i class="bi bi-x"></i></button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

<!-- ===== BANNIÈRES ===== -->
<div class="row g-3 mb-5">
    <div class="col-md-8">
        <div class="promo-construction p-4 text-white rounded-3 h-100 d-flex align-items-center">
            <div>
                <span class="badge bg-white text-orange fw-bold mb-2">NOUVEAU</span>
                <h4 class="fw-bold mb-2">Matériaux de construction</h4>
                <p class="mb-3 opacity-85">Sable, ciment, fer à béton, parpaings, carrelage, tôles...</p>
                <a href="/category/7" class="btn btn-white fw-bold px-4">Découvrir <i class="bi bi-arrow-right ms-1"></i></a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="promo-livraison p-4 text-white rounded-3 h-100 d-flex align-items-center">
            <div>
                <i class="bi bi-truck fs-1 mb-2 d-block"></i>
                <h5 class="fw-bold mb-1">Livraison gratuite</h5>
                <p class="mb-0 opacity-85 small">Dès 50 000 FCFA d'achat à Dakar</p>
            </div>
        </div>
    </div>
</div>

@endsection
