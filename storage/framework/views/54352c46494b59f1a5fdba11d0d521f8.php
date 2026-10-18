<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>FIXIT - Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>

<!-- SIDEBAR -->
<div class="admin-sidebar">
    <div class="text-center mb-4 px-3">
        <h5 class="text-orange fw-bold mb-0"><i class="bi bi-tools"></i> FIXIT</h5>
        <small class="text-secondary">Administration</small>
    </div>
    <a href="/admin" class="active"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
    <a href="/admin/products"><i class="bi bi-box me-2"></i>Produits</a>
    <a href="/admin/products/create"><i class="bi bi-plus-circle me-2"></i>Ajouter produit</a>
    <a href="/admin/categories"><i class="bi bi-tags me-2"></i>Catégories</a>
    <a href="/admin/orders"><i class="bi bi-bag me-2"></i>Commandes</a>
    <a href="/admin/users"><i class="bi bi-people me-2"></i>Utilisateurs</a>
    <hr style="border-color:#333;">
    <a href="/"><i class="bi bi-arrow-left me-2"></i>Voir la boutique</a>
    <form action="<?php echo e(route('logout')); ?>" method="POST" class="px-3 mt-2">
        <?php echo csrf_field(); ?>
        <button class="btn btn-danger btn-sm w-100"><i class="bi bi-box-arrow-right me-1"></i>Déconnexion</button>
    </form>
</div>

<!-- CONTENU -->
<div class="admin-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">Dashboard</h4>
            <small class="text-muted">Bienvenue, <?php echo e(auth()->user()->name); ?></small>
        </div>
        <span class="text-muted small"><i class="bi bi-calendar me-1"></i><?php echo e(now()->format('d/m/Y')); ?></span>
    </div>

    <!-- STATS -->
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#ff6a00,#ee0979);">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mb-0 small opacity-75">Produits</p>
                        <h2 class="fw-bold mb-0"><?php echo e(\App\Models\Product::count()); ?></h2>
                    </div>
                    <i class="bi bi-box fs-1 opacity-50"></i>
                </div>
                <a href="/admin/products" class="text-white small opacity-75">Voir tous →</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#11998e,#38ef7d);">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mb-0 small opacity-75">Catégories</p>
                        <h2 class="fw-bold mb-0"><?php echo e(\App\Models\Category::count()); ?></h2>
                    </div>
                    <i class="bi bi-tags fs-1 opacity-50"></i>
                </div>
                <a href="/admin/categories" class="text-white small opacity-75">Gérer →</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#2193b0,#6dd5ed);">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mb-0 small opacity-75">Commandes</p>
                        <h2 class="fw-bold mb-0"><?php echo e(\App\Models\Order::count()); ?></h2>
                    </div>
                    <i class="bi bi-bag fs-1 opacity-50"></i>
                </div>
                <a href="/admin/orders" class="text-white small opacity-75">Voir →</a>
            </div>
        </div>
        <div class="col-md-3">
            <div class="stat-card" style="background:linear-gradient(135deg,#8e44ad,#c0392b);">
                <div class="d-flex justify-content-between">
                    <div>
                        <p class="mb-0 small opacity-75">Utilisateurs</p>
                        <h2 class="fw-bold mb-0"><?php echo e(\App\Models\User::count()); ?></h2>
                    </div>
                    <i class="bi bi-people fs-1 opacity-50"></i>
                </div>
                <a href="/admin/users" class="text-white small opacity-75">Voir →</a>
            </div>
        </div>
    </div>

    <!-- DERNIERS PRODUITS + COMMANDES -->
    <div class="row g-3">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center bg-white">
                    <h6 class="fw-bold mb-0"><i class="bi bi-box me-2 text-orange"></i>Derniers produits</h6>
                    <a href="/admin/products/create" class="btn btn-orange btn-sm">+ Ajouter</a>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <tbody>
                            <?php $__currentLoopData = \App\Models\Product::latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="ps-3">
                                    <img src="<?php echo e($p->image ? asset('storage/'.$p->image) : 'https://via.placeholder.com/40'); ?>"
                                         width="35" height="35" style="object-fit:cover; border-radius:4px;"
                                         onerror="this.src='https://via.placeholder.com/40'">
                                </td>
                                <td><?php echo e($p->name); ?></td>
                                <td class="text-orange fw-bold"><?php echo e(number_format($p->price, 0, ',', ' ')); ?> F</td>
                                <td>
                                    <span class="badge <?php echo e($p->stock > 0 ? 'bg-success' : 'bg-danger'); ?>">
                                        <?php echo e($p->stock > 0 ? 'En stock' : 'Épuisé'); ?>

                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="fw-bold mb-0"><i class="bi bi-bag me-2 text-orange"></i>Dernières commandes</h6>
                </div>
                <div class="card-body p-0">
                    <table class="table table-sm mb-0">
                        <tbody>
                            <?php $__currentLoopData = \App\Models\Order::with('user')->latest()->take(5)->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $o): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="ps-3 text-orange fw-bold">#<?php echo e($o->id); ?></td>
                                <td><?php echo e($o->user->name ?? 'Invité'); ?></td>
                                <td><?php echo e(number_format($o->total, 0, ',', ' ')); ?> F</td>
                                <td>
                                    <span class="badge bg-warning text-dark"><?php echo e($o->status ?? 'En attente'); ?></span>
                                </td>
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\Users\hp\Desktop\SiteQuincaillerie_final\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>