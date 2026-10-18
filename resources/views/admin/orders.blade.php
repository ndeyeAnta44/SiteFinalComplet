<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>FIXIT - Commandes Admin</title>
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
    <a href="/admin/categories"><i class="bi bi-tags me-2"></i>Catégories</a>
    <a href="/admin/orders" class="active"><i class="bi bi-bag me-2"></i>Commandes</a>
    <a href="/admin/users"><i class="bi bi-people me-2"></i>Utilisateurs</a>
    <hr style="border-color:#333;">
    <a href="/"><i class="bi bi-arrow-left me-2"></i>Voir la boutique</a>
</div>

<div class="admin-content">
    <h4 class="fw-bold mb-4"><i class="bi bi-bag me-2 text-orange"></i>Gestion des commandes</h4>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table class="table table-hover mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="ps-3">#</th>
                        <th>Client</th>
                        <th>Téléphone</th>
                        <th>Ville</th>
                        <th>Paiement</th>
                        <th>Total</th>
                        <th>Statut</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                    <tr>
                        <td class="ps-3 fw-bold text-orange">#{{ $order->id }}</td>
                        <td>{{ $order->first_name }} {{ $order->last_name }}</td>
                        <td>{{ $order->phone }}</td>
                        <td>{{ $order->city }}</td>
                        <td>
                            <span class="badge bg-secondary">
                                {{ $order->payment_method == 'wave' ? 'Wave' : ($order->payment_method == 'orange_money' ? 'Orange Money' : 'Livraison') }}
                            </span>
                        </td>
                        <td class="fw-bold">{{ number_format($order->total, 0, ',', ' ') }} F</td>
                        <td>
                            @php
                                $colors = [
                                    'pending'   => 'warning text-dark',
                                    'confirmed' => 'success',
                                    'shipped'   => 'primary',
                                    'delivered' => 'dark',
                                    'cancelled' => 'danger',
                                ];
                                $labels = [
                                    'pending'   => 'En attente',
                                    'confirmed' => 'Confirmée',
                                    'shipped'   => 'Expédiée',
                                    'delivered' => 'Livrée',
                                    'cancelled' => 'Annulée',
                                ];
                            @endphp
                            <span class="badge bg-{{ $colors[$order->status] ?? 'secondary' }}">
                                {{ $labels[$order->status] ?? $order->status }}
                            </span>
                        </td>
                        <td class="small text-muted">{{ $order->created_at->format('d/m/Y') }}</td>
                        <td>
                            <form action="/admin/orders/{{ $order->id }}/status" method="POST" class="d-flex gap-1">
                                @csrf @method('PUT')
                                <select name="status" class="form-select form-select-sm" style="width:130px;">
                                    <option value="pending"   {{ $order->status=='pending'   ? 'selected' : '' }}>En attente</option>
                                    <option value="confirmed" {{ $order->status=='confirmed' ? 'selected' : '' }}>Confirmée</option>
                                    <option value="shipped"   {{ $order->status=='shipped'   ? 'selected' : '' }}>Expédiée</option>
                                    <option value="delivered" {{ $order->status=='delivered' ? 'selected' : '' }}>Livrée</option>
                                    <option value="cancelled" {{ $order->status=='cancelled' ? 'selected' : '' }}>Annulée</option>
                                </select>
                                <button class="btn btn-sm btn-orange"><i class="bi bi-check"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                        <tr><td colspan="9" class="text-center py-4 text-muted">Aucune commande pour le moment.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
