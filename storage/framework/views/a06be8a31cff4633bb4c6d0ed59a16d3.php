<?php $__env->startSection('content'); ?>
<div class="text-center py-5">
    <div class="mb-4">
        <i class="bi bi-check-circle-fill text-success" style="font-size:5rem;"></i>
    </div>
    <h2 class="fw-bold">Commande confirmée !</h2>
    <p class="text-muted">Merci pour votre commande. Vous recevrez une confirmation par email.</p>
    <p class="text-muted">Numéro de commande : <strong class="text-orange">#<?php echo e($order->id ?? 'N/A'); ?></strong></p>
    <a href="/shop" class="btn btn-orange btn-lg mt-3">
        <i class="bi bi-grid me-2"></i>Continuer les achats
    </a>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\SiteQuincaillerie_final\resources\views/order_success.blade.php ENDPATH**/ ?>