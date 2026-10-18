<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>FIXIT - Modifier Produit</title>
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
    <hr style="border-color:#333;">
    <a href="/"><i class="bi bi-arrow-left me-2"></i>Voir la boutique</a>
</div>

<div class="admin-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold"><i class="bi bi-pencil me-2 text-orange"></i>Modifier : <?php echo e($product->name); ?></h4>
        <a href="/admin/products" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>

    <div class="card shadow-sm p-4" style="max-width:700px;">
        <form action="/admin/products/<?php echo e($product->id); ?>" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nom *</label>
                <input type="text" name="name" value="<?php echo e($product->name); ?>" class="form-control" required>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Prix (FCFA) *</label>
                    <input type="number" name="price" value="<?php echo e($product->price); ?>" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Stock *</label>
                    <input type="number" name="stock" value="<?php echo e($product->stock); ?>" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Catégorie</label>
                <select name="category_id" class="form-select">
                    <?php $__currentLoopData = \App\Models\Category::all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>" <?php echo e($product->category_id == $cat->id ? 'selected' : ''); ?>>
                            <?php echo e($cat->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control" rows="3"><?php echo e($product->description); ?></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Image actuelle</label>
                <?php if($product->image): ?>
                    <div class="mb-2">
                        <img src="<?php echo e($product->image_src); ?>" width="150" height="110"
                             style="object-fit:cover; border-radius:8px; border:2px solid #ff6a00;"
                             onerror="this.src='https://via.placeholder.com/150x110'" id="currentImg">
                    </div>
                <?php endif; ?>
                <label class="form-label fw-semibold">Nouvelle image (optionnel)</label>
                <input type="file" name="image" class="form-control" accept="image/*"
                       onchange="previewImage(this)">
                <small class="text-muted">Laissez vide pour garder l'image actuelle.</small>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-check-circle me-2"></i>Enregistrer
                </button>
                <a href="/admin/products" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<script>
function previewImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.getElementById('currentImg');
            if(img) img.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\Users\hp\Desktop\SiteQuincaillerie_final\resources\views/admin/products/edit.blade.php ENDPATH**/ ?>