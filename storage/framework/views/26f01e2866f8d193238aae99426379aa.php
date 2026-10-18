<?php $__env->startSection('content'); ?>
<h3 class="fw-bold mb-4"><i class="bi bi-cart3 me-2 text-orange"></i>Mon Panier</h3>

<?php if(count(session('cart', [])) == 0): ?>
    <div class="text-center py-5">
        <i class="bi bi-cart-x fs-1 text-muted d-block mb-3"></i>
        <p class="text-muted">Votre panier est vide.</p>
        <a href="/shop" class="btn btn-orange"><i class="bi bi-grid me-2"></i>Continuer les achats</a>
    </div>
<?php else: ?>
<div class="row g-4">
    <div class="col-md-8">
        <div class="card shadow-sm">
            <div class="card-body p-0">
                <form action="/cart/update" method="POST">
                    <?php echo csrf_field(); ?>
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-3">Produit</th>
                                <th>Prix unitaire</th>
                                <th>Quantité</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            <?php $__currentLoopData = session('cart', []); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $id => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $total += $item['price'] * $item['quantity']; ?>
                                <tr>
                                    <td class="ps-3">
                                        <div class="d-flex align-items-center gap-2">
                                            <?php if($item['image']): ?>
                                                <img src="<?php echo e(asset('storage/'.$item['image'])); ?>" width="50" height="50"
                                                     style="object-fit:cover; border-radius:6px;"
                                                     onerror="this.src='https://via.placeholder.com/50'">
                                            <?php endif; ?>
                                            <span class="fw-semibold"><?php echo e($item['name']); ?></span>
                                        </div>
                                    </td>
                                    <td class="text-orange fw-bold"><?php echo e(number_format($item['price'], 0, ',', ' ')); ?> FCFA</td>
                                    <td style="width:100px;">
                                        <input type="number" name="quantities[<?php echo e($id); ?>]"
                                               value="<?php echo e($item['quantity']); ?>" min="1"
                                               class="form-control form-control-sm">
                                    </td>
                                    <td class="fw-bold"><?php echo e(number_format($item['price'] * $item['quantity'], 0, ',', ' ')); ?> FCFA</td>
                                    <td>
                                        <a href="/cart/remove/<?php echo e($id); ?>" class="btn btn-danger btn-sm">
                                            <i class="bi bi-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="p-3 d-flex gap-2">
                        <button class="btn btn-warning btn-sm">
                            <i class="bi bi-arrow-clockwise me-1"></i>Mettre à jour
                        </button>
                        <a href="/shop" class="btn btn-outline-secondary btn-sm">
                            <i class="bi bi-arrow-left me-1"></i>Continuer les achats
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- RÉSUMÉ -->
    <div class="col-md-4">
        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold border-bottom pb-2 mb-3">Résumé de commande</h5>
                <div class="d-flex justify-content-between mb-2">
                    <span>Sous-total</span>
                    <span><?php echo e(number_format($total, 0, ',', ' ')); ?> FCFA</span>
                </div>
                <div class="d-flex justify-content-between mb-2 text-muted small">
                    <span>Livraison</span>
                    <span><?php echo e($total >= 50000 ? 'Gratuite' : '2 000 FCFA'); ?></span>
                </div>
                <hr>
                <div class="d-flex justify-content-between fw-bold fs-5">
                    <span>Total</span>
                    <span class="text-orange"><?php echo e(number_format($total >= 50000 ? $total : $total + 2000, 0, ',', ' ')); ?> FCFA</span>
                </div>
                <?php if($total < 50000): ?>
                    <p class="text-muted small mt-2">
                        <i class="bi bi-info-circle me-1"></i>
                        Plus que <?php echo e(number_format(50000 - $total, 0, ',', ' ')); ?> FCFA pour la livraison gratuite !
                    </p>
                <?php endif; ?>
                <a href="/checkout" class="btn btn-orange w-100 mt-3 btn-lg">
                    <i class="bi bi-credit-card me-2"></i>Passer commande
                </a>
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\SiteQuincaillerie_final\resources\views/cart.blade.php ENDPATH**/ ?>