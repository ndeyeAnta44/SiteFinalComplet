<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-center align-items-center" style="min-height:75vh;">
    <div class="card p-4 shadow" style="width:380px;">
        <div class="text-center mb-4">
            <i class="bi bi-tools text-orange fs-2"></i>
            <h4 class="fw-bold mt-1">Connexion</h4>
            <p class="text-muted small">Accédez à votre espace FIXIT</p>
        </div>

        <?php if(session('error')): ?>
            <div class="alert alert-danger py-2"><i class="bi bi-exclamation-circle me-2"></i><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <form method="POST" action="/login">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="votre@email.com"
                           value="<?php echo e(old('email')); ?>" required autofocus>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="••••••" required>
                </div>
            </div>
            <button class="btn btn-orange w-100 py-2 fw-bold">
                <i class="bi bi-box-arrow-in-right me-2"></i>Se connecter
            </button>
        </form>

        <hr>
        <p class="text-center text-muted small mb-0">
            Pas encore de compte ?
            <a href="/register" class="text-orange fw-bold">Créer un compte</a>
        </p>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\SiteQuincaillerie_final\resources\views/auth/login.blade.php ENDPATH**/ ?>