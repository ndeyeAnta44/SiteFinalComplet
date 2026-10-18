<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>FIXIT - Catégories Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
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
    <a href="/admin/categories" class="active"><i class="bi bi-tags me-2"></i>Catégories</a>
    <a href="/admin/orders"><i class="bi bi-bag me-2"></i>Commandes</a>
    <a href="/admin/users"><i class="bi bi-people me-2"></i>Utilisateurs</a>
    <hr style="border-color:#333;">
    <a href="/"><i class="bi bi-arrow-left me-2"></i>Voir la boutique</a>
</div>

<div class="admin-content">
    <h4 class="fw-bold mb-4"><i class="bi bi-tags me-2 text-orange"></i>Gestion des catégories</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="row g-4">
        <!-- AJOUT -->
        <div class="col-md-4">
            <div class="card shadow-sm p-4">
                <h6 class="fw-bold mb-3 border-bottom pb-2"><i class="bi bi-plus-circle me-2 text-orange"></i>Nouvelle catégorie</h6>
                <form method="POST" action="/admin/categories">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Nom</label>
                        <input type="text" name="name" class="form-control" placeholder="Ex: Outillage électrique" required>
                    </div>
                    <button class="btn btn-orange w-100">
                        <i class="bi bi-plus me-1"></i>Ajouter
                    </button>
                </form>
            </div>
        </div>

        <!-- LISTE -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body p-0">
                    <table class="table table-hover mb-0">
                        <thead class="bg-light">
                            <tr>
                                <th class="ps-3">Catégorie</th>
                                <th>Nb Produits</th>
                                <th>Modifier</th>
                                <th>Supprimer</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $cat)
                            <tr>
                                <td class="ps-3 fw-semibold">{{ $cat->name }}</td>
                                <td><span class="badge bg-secondary">{{ $cat->products_count }}</span></td>
                                <td>
                                    <form method="POST" action="/admin/categories/{{ $cat->id }}" class="d-flex gap-1">
                                        @csrf @method('PUT')
                                        <input type="text" name="name" value="{{ $cat->name }}" class="form-control form-control-sm" style="width:160px;">
                                        <button class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></button>
                                    </form>
                                </td>
                                <td>
                                    <form method="POST" action="/admin/categories/{{ $cat->id }}"
                                          onsubmit="return confirm('Supprimer cette catégorie ?')">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm"><i class="bi bi-trash"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                                <tr><td colspan="4" class="text-center py-4 text-muted">Aucune catégorie.</td></tr>
                            @endforelse
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
