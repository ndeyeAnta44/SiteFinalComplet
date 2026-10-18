@extends('layouts.app')
@section('content')
<div class="text-center py-5">
    <div class="mb-4">
        <i class="bi bi-check-circle-fill text-success" style="font-size:5rem;"></i>
    </div>
    <h2 class="fw-bold">Commande confirmée !</h2>
    <p class="text-muted">Merci pour votre commande. Vous recevrez une confirmation par email.</p>
    <p class="text-muted">Numéro de commande : <strong class="text-orange">#{{ $order->id ?? 'N/A' }}</strong></p>
    <a href="/shop" class="btn btn-orange btn-lg mt-3">
        <i class="bi bi-grid me-2"></i>Continuer les achats
    </a>
</div>
@endsection
