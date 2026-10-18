<?php $__env->startSection('content'); ?>
<h3 class="fw-bold mb-4"><i class="bi bi-box me-2 text-orange"></i>Mes commandes</h3>

<?php if($orders->isEmpty()): ?>
    <div class="text-center py-5 text-muted">
        <i class="bi bi-box fs-1 d-block mb-3"></i>
        <p>Vous n'avez pas encore passé de commande.</p>
        <a href="/shop" class="btn btn-orange">Commencer mes achats</a>
    </div>
<?php else: ?>
<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-hover mb-0">
            <thead class="bg-light">
                <tr>
                    <th class="ps-3">Commande</th>
                    <th>Date</th>
                    <th>Total</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $orders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $order): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td class="ps-3 fw-bold text-orange">#<?php echo e($order->id); ?></td>
                    <td><?php echo e($order->created_at->format('d/m/Y')); ?></td>
                    <td><?php echo e(number_format($order->total, 0, ',', ' ')); ?> FCFA</td>
                    <td>
                        <?php
                            $statusClass = match($order->status ?? 'pending') {
                                'confirmed' => 'success',
                                'shipped' => 'primary',
                                'delivered' => 'dark',
                                default => 'warning text-dark'
                            };
                            $statusLabel = match($order->status ?? 'pending') {
                                'confirmed' => 'Confirmée',
                                'shipped' => 'Expédiée',
                                'delivered' => 'Livrée',
                                default => 'En attente'
                            };
                        ?>
                        <span class="badge bg-<?php echo e($statusClass); ?>"><?php echo e($statusLabel); ?></span>
                    </td>
                    <td><a href="/orders/<?php echo e($order->id); ?>" class="btn btn-sm btn-outline-secondary">Détails</a></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\SiteQuincaillerie_final\resources\views/orders.blade.php ENDPATH**/ ?>