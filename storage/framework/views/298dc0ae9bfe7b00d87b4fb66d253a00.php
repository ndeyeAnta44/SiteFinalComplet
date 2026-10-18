<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>FIXIT - Utilisateurs Admin</title>
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
    <a href="/admin/products"><i class="bi bi-box me-2"></i>Produits</a>
    <a href="/admin/products/create"><i class="bi bi-plus-circle me-2"></i>Ajouter produit</a>
    <a href="/admin/categories"><i class="bi bi-tags me-2"></i>Catégories</a>
    <a href="/admin/orders"><i class="bi bi-bag me-2"></i>Commandes</a>
    <a href="/admin/users" class="active"><i class="bi bi-people me-2"></i>Utilisateurs</a>
    <hr style="border-color:#333;">
    <a href="/"><i class="bi bi-arrow-left me-2"></i>Voir la boutique</a>
</div>

<div class="admin-content">
    <h4 class="fw-bold mb-4"><i class="bi bi-people me-2 text-orange"></i>Utilisateurs inscrits</h4>

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Nom</th>
                        <th>Email</th>
                        <th>Rôle</th>
                        <th>Inscrit le</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td class="ps-3 text-muted"><?php echo e($user->id); ?></td>
                        <td class="fw-semibold"><?php echo e($user->name); ?></td>
                        <td><?php echo e($user->email); ?></td>
                        <td>
                            <span class="badge <?php echo e($user->role === 'admin' ? 'bg-danger' : 'bg-primary'); ?>">
                                <?php echo e($user->role === 'admin' ? 'Admin' : 'Client'); ?>

                            </span>
                        </td>
                        <td class="small text-muted"><?php echo e($user->created_at->format('d/m/Y')); ?></td>
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
<?php /**PATH C:\Users\hp\Desktop\SiteQuincaillerie_final\resources\views/admin/users.blade.php ENDPATH**/ ?>