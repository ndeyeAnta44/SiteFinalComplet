<?php $__env->startSection('content'); ?>

<div class="row">
    <!-- SIDEBAR FILTRES -->
    <div class="col-md-3 mb-4">
        <div class="card shadow-sm p-3">
            <h6 class="fw-bold border-bottom pb-2 mb-3"><i class="bi bi-funnel me-2 text-orange"></i>Catégories</h6>
            <a href="/shop" class="d-block text-decoration-none mb-2 text-dark fw-bold">
                <i class="bi bi-grid me-1"></i> Tous les produits
            </a>
            <?php $sideCategories = \App\Models\Category::all(); ?>
            <?php $__currentLoopData = $sideCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="/category/<?php echo e($cat->id); ?>" class="d-block text-decoration-none mb-2 text-secondary footer-link">
                    <i class="bi bi-chevron-right me-1"></i><?php echo e($cat->name); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>

    <!-- PRODUITS -->
    <div class="col-md-9">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="fw-bold mb-0">
                <i class="bi bi-grid me-2 text-orange"></i>
                <?php if(isset($categoryName)): ?> <?php echo e($categoryName); ?> <?php else: ?> Tous les produits <?php endif; ?>
            </h4>
            <span class="text-muted small"><?php echo e(count($products)); ?> produit(s)</span>
        </div>

        <div class="row g-3">
            <?php $__empty_1 = true; $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="col-6 col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="position-relative">
                        <img src="<?php echo e($product->image ? $product->image_src : 'https://via.placeholder.com/300x200?text='.urlencode($product->name)); ?>"
                             class="card-img-top" style="height:190px; object-fit:cover;" alt="<?php echo e($product->name); ?>">
                        <?php if($product->stock <= 0): ?>
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">Épuisé</span>
                        <?php elseif($product->stock <= 5): ?>
                            <span class="badge bg-warning text-dark position-absolute top-0 end-0 m-2">Stock limité</span>
                        <?php endif; ?>
                    </div>
                    <div class="card-body p-2">
                        <span class="badge-cat"><?php echo e($product->category->name ?? ''); ?></span>
                        <h6 class="card-title mt-1 mb-1"><?php echo e($product->name); ?></h6>
                        <p class="text-muted small mb-1" style="font-size:12px;">
                            <?php echo e(Str::limit($product->description, 50)); ?>

                        </p>
                        <strong class="text-orange"><?php echo e(number_format($product->price, 0, ',', ' ')); ?> FCFA</strong>
                    </div>
                    <div class="card-footer p-2 bg-white border-0">
                        <div class="d-flex gap-1">
                            <a href="/product/<?php echo e($product->id); ?>" class="btn btn-outline-secondary btn-sm flex-fill">
                                <i class="bi bi-eye"></i>
                            </a>
                            <?php if($product->stock > 0): ?>
                                <a href="/add-to-cart/<?php echo e($product->id); ?>" class="btn btn-orange btn-sm flex-fill">
                                    <i class="bi bi-cart-plus"></i> Ajouter
                                </a>
                            <?php else: ?>
                                <button class="btn btn-secondary btn-sm flex-fill" disabled>Épuisé</button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5 text-muted">
                    <i class="bi bi-box-seam fs-1 d-block mb-3"></i>
                    <p>Aucun produit disponible dans cette catégorie.</p>
                    <a href="/shop" class="btn btn-orange">Voir tous les produits</a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\Mon Site de Quincaillerie\SiteQuincaillerie_final\resources\views/shop.blade.php ENDPATH**/ ?>