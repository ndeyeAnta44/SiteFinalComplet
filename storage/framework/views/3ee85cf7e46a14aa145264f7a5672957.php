<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>FIXIT - Produits Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">
</head>
<body>
<div class="admin-sidebar">
    <div class="text-center mb-4 px-3">
        <h5 class="text-orange fw-bold mb-0"><i class="bi bi-tools"></i> FIXIT</h5>
        <small class="text-secondary">Administration</small>
    </div>
    <a href="/admin"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
    <a href="/admin/products" class="active"><i class="bi bi-box me-2"></i>Produits</a>
    <a href="/admin/products/create"><i class="bi bi-plus-circle me-2"></i>Ajouter produit</a>
    <a href="/admin/categories"><i class="bi bi-tags me-2"></i>Catégories</a>
    <a href="/admin/orders"><i class="bi bi-bag me-2"></i>Commandes</a>
    <a href="/admin/users"><i class="bi bi-people me-2"></i>Utilisateurs</a>
    <hr style="border-color:#333;">
    <a href="/"><i class="bi bi-arrow-left me-2"></i>Voir la boutique</a>
</div>

<div class="admin-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold"><i class="bi bi-box me-2 text-orange"></i>Gestion Produits</h4>
        <a href="/admin/products/create" class="btn btn-orange">
            <i class="bi bi-plus-circle me-1"></i>Ajouter produit
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i><?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">Image</th>
                        <th>Nom</th>
                        <th>Catégorie</th>
                        <th>Prix</th>
                        <th>Stock</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="ps-3">
                            <img src="<?php echo e($product->image ?  $product->image_src  : 'https://via.placeholder.com/60x50?text=N/A'); ?>"
                                 width="60" height="50" style="object-fit:cover; border-radius:6px;"
                                 onerror="this.src='https://via.placeholder.com/60x50?text=N/A'">
                        </td>
                        <td class="fw-semibold"><?php echo e($product->name); ?></td>
                        <td><span class="badge-cat"><?php echo e($product->category->name ?? '-'); ?></span></td>
                        <td class="text-orange fw-bold"><?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA</td>
                        <td>
                            <span class="badge <?php echo e($product->stock > 5 ? 'bg-success' : ($product->stock > 0 ? 'bg-warning text-dark' : 'bg-danger')); ?>">
                                <?php echo e($product->stock); ?>

                            </span>
                        </td>
                        <td>
                            <a href="/admin/products/<?php echo e($product->id); ?>/edit" class="btn btn-primary btn-sm me-1">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="/admin/products/<?php echo e($product->id); ?>" method="POST" style="display:inline;"
                                  onsubmit="return confirm('Supprimer ce produit ?')">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\Users\hp\Desktop\SiteQuincaillerie_final\resources\views/admin/products/index.blade.php ENDPATH**/ ?>