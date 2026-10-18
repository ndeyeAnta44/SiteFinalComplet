<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>FIXIT - Ajouter Produit</title>
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
    <a href="/admin/products/create" class="active"><i class="bi bi-plus-circle me-2"></i>Ajouter produit</a>
    <a href="/admin/categories"><i class="bi bi-tags me-2"></i>Catégories</a>
    <a href="/admin/orders"><i class="bi bi-bag me-2"></i>Commandes</a>
    <hr style="border-color:#333;">
    <a href="/"><i class="bi bi-arrow-left me-2"></i>Voir la boutique</a>
</div>

<div class="admin-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold"><i class="bi bi-plus-circle me-2 text-orange"></i>Ajouter un produit</h4>
        <a href="/admin/products" class="btn btn-outline-secondary btn-sm">
            <i class="bi bi-arrow-left me-1"></i>Retour
        </a>
    </div>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $e): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> <div><?php echo e($e); ?></div> <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <div class="card shadow-sm p-4" style="max-width:700px;">
        <form method="POST" action="/admin/products" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nom du produit *</label>
                <input type="text" name="name" class="form-control" placeholder="Ex: Marteau 500g" required>
            </div>

            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Prix (FCFA) *</label>
                    <input type="number" name="price" class="form-control" placeholder="Ex: 15000" min="0" required>
                </div>
                <div class="col-md-6">
                    <label class="form-label fw-semibold">Stock *</label>
                    <input type="number" name="stock" class="form-control" placeholder="Ex: 50" min="0" required>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Catégorie *</label>
                <select name="category_id" class="form-select" required>
                    <option value="">-- Choisir --</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat->id); ?>"><?php echo e($cat->name); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Description</label>
                <textarea name="description" class="form-control" rows="3" placeholder="Description du produit..."></textarea>
            </div>

            <!-- IMAGE : choix upload OU URL -->
            <div class="mb-3">
                <label class="form-label fw-semibold">Image du produit</label>

                <ul class="nav nav-tabs mb-2" id="imageTab">
                    <li class="nav-item">
                        <button class="nav-link active" type="button" onclick="switchTab('upload')">
                            <i class="bi bi-upload me-1"></i>Uploader une image
                        </button>
                    </li>
                    <li class="nav-item">
                        <button class="nav-link" type="button" onclick="switchTab('url')">
                            <i class="bi bi-link-45deg me-1"></i>Lien URL
                        </button>
                    </li>
                </ul>

                <div id="tab-upload">
                    <input type="file" name="image" class="form-control" accept="image/*"
                           onchange="previewImg(this)">
                    <small class="text-muted">JPG, PNG, WEBP — max 2Mo</small>
                </div>

                <div id="tab-url" style="display:none;">
                    <input type="url" name="image_url" class="form-control"
                           placeholder="https://exemple.com/image.jpg"
                           onchange="previewUrl(this)">
                    <small class="text-muted">Lien direct vers une image en ligne</small>
                </div>

                <div class="mt-2" id="imgPreview" style="display:none;">
                    <img id="previewImg" src="" width="160" height="130"
                         style="object-fit:cover; border-radius:8px; border:2px solid #ff6a00;">
                </div>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-orange px-4">
                    <i class="bi bi-check-circle me-2"></i>Ajouter
                </button>
                <a href="/admin/products" class="btn btn-outline-secondary">Annuler</a>
            </div>
        </form>
    </div>
</div>

<script>
function switchTab(tab){
    document.getElementById('tab-upload').style.display = tab === 'upload' ? 'block' : 'none';
    document.getElementById('tab-url').style.display    = tab === 'url'    ? 'block' : 'none';
    document.querySelectorAll('.nav-link').forEach((el,i) => el.classList.toggle('active', (tab==='upload'&&i===0)||(tab==='url'&&i===1)));
}
function previewImg(input){
    if(input.files && input.files[0]){
        const r = new FileReader();
        r.onload = e => { document.getElementById('previewImg').src = e.target.result; document.getElementById('imgPreview').style.display='block'; };
        r.readAsDataURL(input.files[0]);
    }
}
function previewUrl(input){
    if(input.value){ document.getElementById('previewImg').src = input.value; document.getElementById('imgPreview').style.display='block'; }
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH C:\Users\hp\Desktop\SiteQuincaillerie_final\resources\views/admin/products/create.blade.php ENDPATH**/ ?>