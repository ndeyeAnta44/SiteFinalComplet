<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moderne - Quincaillerie Professionnelle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>

<!-- TOP BAR -->
<div class="bg-dark text-white py-1 px-3 d-flex justify-content-between align-items-center small">
    <span><i class="bi bi-telephone-fill me-1"></i> +221 78 510 13 89 &nbsp;|&nbsp; <i class="bi bi-envelope-fill me-1"></i> contact@fixit.sn</span>
    <span><i class="bi bi-clock me-1"></i> Lun-Sam : 8h00 – 18h00</span>
</div>

<!-- NAVBAR -->
<nav class="navbar bg-orange shadow-sm py-2">
    <div class="container">
        <div class="d-flex align-items-center gap-3">
            <button class="btn text-white fs-4 p-0" onclick="toggleMenu()">
                <i class="bi bi-list"></i>
            </button>
            <a href="/" class="navbar-brand text-white fw-bold fs-4 mb-0">
                <i class="bi bi-tools me-1"></i>Quincaillerie Moderne
            </a>
        </div>

        <form action="/search" method="GET" class="d-none d-md-flex mx-3 flex-grow-1" style="max-width:400px;">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Rechercher un produit...">
                <button class="btn btn-dark" type="submit"><i class="bi bi-search"></i></button>
            </div>
        </form>

        <div class="d-flex align-items-center gap-2">
            <a href="/" class="text-white text-decoration-none d-none d-md-block">Accueil</a>
            <a href="/shop" class="text-white text-decoration-none d-none d-md-block">Boutique</a>

            <?php if(auth()->user() && auth()->user()->role === 'admin'): ?>
                <a href="/admin" class="btn btn-warning btn-sm">
                    <i class="bi bi-speedometer2"></i> Admin
                </a>
            <?php endif; ?>

            <a href="/cart" class="text-white text-decoration-none position-relative ms-1">
                <i class="bi bi-cart3 fs-5"></i>
                <?php $cartCount = count(session('cart', [])); ?>
                <?php if($cartCount > 0): ?>
                    <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill" style="font-size:10px;"><?php echo e($cartCount); ?></span>
                <?php endif; ?>
            </a>

            <?php if(auth()->guard()->check()): ?>
                <div class="dropdown">
                    <button class="btn btn-dark btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="bi bi-person-circle"></i> <?php echo e(auth()->user()->name); ?>

                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li><a class="dropdown-item" href="/orders"><i class="bi bi-box me-2"></i>Mes commandes</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="<?php echo e(route('logout')); ?>" method="POST" class="px-3">
                                <?php echo csrf_field(); ?>
                                <button class="btn btn-danger btn-sm w-100"><i class="bi bi-box-arrow-right"></i> Déconnexion</button>
                            </form>
                        </li>
                    </ul>
                </div>
            <?php endif; ?>

            <?php if(auth()->guard()->guest()): ?>
                <a href="/login" class="btn btn-dark btn-sm">
                    <i class="bi bi-person"></i> Connexion
                </a>
            <?php endif; ?>
        </div>
    </div>
</nav>

<!-- MENU LATERAL -->
<div id="sideMenu" class="side-menu shadow">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <span class="fw-bold text-orange fs-5"><i class="bi bi-tools"></i> FIXIT</span>
        <button class="btn btn-sm btn-light" onclick="toggleMenu()">✕</button>
    </div>
    <a href="/"><i class="bi bi-house me-2"></i>Accueil</a>
    <a href="/shop"><i class="bi bi-grid me-2"></i>Boutique</a>
    <a href="/cart"><i class="bi bi-cart me-2"></i>Panier</a>
    <hr>
    <p class="text-muted small fw-bold mb-2">CATÉGORIES</p>
    <?php $allCategories = \App\Models\Category::all(); ?>
    <?php $__currentLoopData = $allCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <a href="/category/<?php echo e($cat->id); ?>"><i class="bi bi-tag me-2"></i><?php echo e($cat->name); ?></a>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <hr>
    <?php if(auth()->guard()->check()): ?>
        <a href="/orders"><i class="bi bi-box me-2"></i>Mes commandes</a>
    <?php endif; ?>
    <?php if(auth()->guard()->guest()): ?>
        <a href="/login"><i class="bi bi-person me-2"></i>Connexion</a>
        <a href="/register"><i class="bi bi-person-plus me-2"></i>Inscription</a>
    <?php endif; ?>
</div>
<div id="overlay" onclick="toggleMenu()"></div>

<div class="container mt-2">
    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show py-2">
            <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
    <?php if(session('error')): ?>
        <div class="alert alert-danger alert-dismissible fade show py-2">
            <i class="bi bi-exclamation-circle me-2"></i><?php echo e(session('error')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>
</div>

<main class="container mt-4 mb-5">
    <?php echo $__env->yieldContent('content'); ?>
</main>

<!-- FOOTER -->
<footer class="text-white mt-auto">
    <!-- BANDE AVANTAGES -->
    <div class="bg-orange py-3">
        <div class="container d-flex flex-wrap justify-content-center gap-4 align-items-center text-white">
            <span><i class="bi bi-truck me-2"></i><strong>Livraison rapide</strong></span>
            <span><i class="bi bi-shield-check me-2"></i><strong>Produits garantis</strong></span>
            <span><i class="bi bi-headset me-2"></i><strong>Support 6j/7</strong></span>
            <span><i class="bi bi-arrow-counterclockwise me-2"></i><strong>Retours 7 jours</strong></span>
        </div>
    </div>

    <!-- CORPS -->
    <div class="bg-dark py-5">
        <div class="container">
            <div class="row g-4">
                <!-- À PROPOS -->
                <div class="col-md-3">
                    <h5 class="text-orange fw-bold mb-3"><i class="bi bi-tools me-2"></i>FIXIT</h5>
                    <p class="text-secondary small">Votre boutique de quincaillerie professionnelle au Sénégal. Outillage, visserie, électricité, plomberie et bien plus.</p>
                    <div class="d-flex gap-3 mt-3">
                        <a href="#" class="text-orange fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-orange fs-5"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-orange fs-5"><i class="bi bi-whatsapp"></i></a>
                        <a href="#" class="text-orange fs-5"><i class="bi bi-youtube"></i></a>
                    </div>
                </div>

                <!-- LIENS -->
                <div class="col-md-3">
                    <h6 class="text-white fw-bold mb-3 border-bottom border-orange pb-2">Liens rapides</h6>
                    <ul class="list-unstyled">
                        <li class="mb-1"><a href="/" class="footer-link"><i class="bi bi-chevron-right me-1"></i>Accueil</a></li>
                        <li class="mb-1"><a href="/shop" class="footer-link"><i class="bi bi-chevron-right me-1"></i>Boutique</a></li>
                        <li class="mb-1"><a href="/cart" class="footer-link"><i class="bi bi-chevron-right me-1"></i>Panier</a></li>
                        <li class="mb-1"><a href="/checkout" class="footer-link"><i class="bi bi-chevron-right me-1"></i>Commander</a></li>
                        <li class="mb-1"><a href="/orders" class="footer-link"><i class="bi bi-chevron-right me-1"></i>Mes commandes</a></li>
                    </ul>
                </div>

                <!-- CATÉGORIES -->
                <div class="col-md-3">
                    <h6 class="text-white fw-bold mb-3 border-bottom border-orange pb-2">Catégories</h6>
                    <ul class="list-unstyled">
                        <?php $footerCats = \App\Models\Category::take(5)->get(); ?>
                        <?php $__currentLoopData = $footerCats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <li class="mb-1">
                                <a href="/category/<?php echo e($cat->id); ?>" class="footer-link">
                                    <i class="bi bi-chevron-right me-1"></i><?php echo e($cat->name); ?>

                                </a>
                            </li>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </ul>
                </div>

                <!-- CONTACT -->
                <div class="col-md-3">
                    <h6 class="text-white fw-bold mb-3 border-bottom border-orange pb-2">Contact</h6>
                    <ul class="list-unstyled text-secondary small">
                        <li class="mb-2"><i class="bi bi-geo-alt-fill text-orange me-2"></i>Dakar, Sénégal — Marché HLM</li>
                        <li class="mb-2"><i class="bi bi-telephone-fill text-orange me-2"></i>+221 77 000 00 00</li>
                        <li class="mb-2"><i class="bi bi-envelope-fill text-orange me-2"></i>contact@fixit.sn</li>
                        <li class="mb-2"><i class="bi bi-clock-fill text-orange me-2"></i>Lun–Sam : 8h00 – 18h00</li>
                    </ul>
                    <p class="small text-white mb-1 mt-3">Newsletter</p>
                    <div class="input-group input-group-sm">
                        <input type="email" class="form-control" placeholder="Votre email">
                        <button class="btn btn-orange btn-sm">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- BAS -->
    <div class="bg-black py-3 text-center text-secondary small">
        <div class="container">
            <span>© <?php echo e(date('Y')); ?> Quincaillerie Moderne — Tous droits réservés</span>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
let menuOpen = false;
function toggleMenu(){
    const menu = document.getElementById('sideMenu');
    const overlay = document.getElementById('overlay');
    if(menuOpen){
        menu.style.left = "-280px";
        overlay.style.display = "none";
        menuOpen = false;
    } else {
        menu.style.left = "0";
        overlay.style.display = "block";
        menuOpen = true;
    }
}
</script>
</body>
</html>
<?php /**PATH C:\Users\hp\Desktop\SiteQuincaillerie_final\resources\views/layouts/app.blade.php ENDPATH**/ ?>