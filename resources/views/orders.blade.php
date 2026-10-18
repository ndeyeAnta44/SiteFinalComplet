@extends('layouts.app')
@section('content')
<h3 class="fw-bold mb-4"><i class="bi bi-box me-2 text-orange"></i>Mes commandes</h3>

@if($orders->isEmpty())
    <div class="text-center py-5 text-muted">
        <i class="bi bi-box fs-1 d-block mb-3"></i>
        <p>Vous n'avez pas encore passé de commande.</p>
        <a href="/shop" class="btn btn-orange">Commencer mes achats</a>
    </div>
@else
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
                @foreach($orders as $order)
                <tr>
                    <td class="ps-3 fw-bold text-orange">#{{ $order->id }}</td>
                    <td>{{ $order->created_at->format('d/m/Y') }}</td>
                    <td>{{ number_format($order->total, 0, ',', ' ') }} FCFA</td>
                    <td>
                        @php
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
                        @endphp
                        <span class="badge bg-{{ $statusClass }}">{{ $statusLabel }}</span>
                    </td>
                    <td><a href="/orders/{{ $order->id }}" class="btn btn-sm btn-outline-secondary">Détails</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif
@endsection
