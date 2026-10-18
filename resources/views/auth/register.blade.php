@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-center align-items-center" style="min-height:75vh;">
    <div class="card p-4 shadow" style="width:400px;">
        <div class="text-center mb-4">
            <i class="bi bi-tools text-orange fs-2"></i>
            <h4 class="fw-bold mt-1">Créer un compte</h4>
            <p class="text-muted small">Rejoignez la communauté FIXIT</p>
        </div>

        @if($errors->any())
            <div class="alert alert-danger py-2">
                @foreach($errors->all() as $error)
                    <div><i class="bi bi-exclamation-circle me-1"></i>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/register">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-semibold">Nom complet</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <input type="text" name="name" class="form-control" placeholder="Votre nom"
                           value="{{ old('name') }}" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Email</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <input type="email" name="email" class="form-control" placeholder="votre@email.com"
                           value="{{ old('email') }}" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                    <input type="password" name="password" class="form-control" placeholder="Min 6 caractères" required>
                </div>
            </div>
            <div class="mb-3">
                <label class="form-label fw-semibold">Confirmer le mot de passe</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-lock-fill"></i></span>
                    <input type="password" name="password_confirmation" class="form-control" placeholder="Répétez le mot de passe" required>
                </div>
            </div>
            <button class="btn btn-orange w-100 py-2 fw-bold">
                <i class="bi bi-person-plus me-2"></i>Créer mon compte
            </button>
        </form>

        <hr>
        <p class="text-center text-muted small mb-0">
            Déjà un compte ?
            <a href="/login" class="text-orange fw-bold">Se connecter</a>
        </p>
    </div>
</div>
@endsection
