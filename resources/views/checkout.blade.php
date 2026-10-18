@extends('layouts.app')

@section('content')
<h3 class="fw-bold mb-4"><i class="bi bi-credit-card me-2 text-orange"></i>Passer commande</h3>

@if(!auth()->check())
    <div class="alert alert-warning">
        <i class="bi bi-exclamation-triangle me-2"></i>
        Vous devez être <a href="/login" class="fw-bold">connecté</a> pour passer commande.
    </div>
@endif

<div class="row g-4">
    <!-- FORMULAIRE -->
    <div class="col-md-7">
        <div class="card shadow-sm p-4">
            <h5 class="fw-bold mb-3 border-bottom pb-2">Informations de livraison</h5>
            <form action="/checkout" method="POST">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Prénom</label>
                        <input type="text" name="first_name" class="form-control"
                               value="{{ auth()->user()->name ?? '' }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Nom</label>
                        <input type="text" name="last_name" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Email</label>
                        <input type="email" name="email" class="form-control"
                               value="{{ auth()->user()->email ?? '' }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Téléphone</label>
                        <input type="text" name="phone" class="form-control" placeholder="+221 77..." required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label fw-semibold">Ville</label>
                        <select name="city" class="form-select" required>
                            <option value="Dakar">Dakar</option>
                            <option value="Thiès">Thiès</option>
                            <option value="Saint-Louis">Saint-Louis</option>
                            <option value="Ziguinchor">Ziguinchor</option>
                            <option value="Autre">Autre</option>
                        </select>
                    </div>
                    <div class="col-12">
                        <label class="form-label fw-semibold">Adresse de livraison</label>
                        <textarea name="address" class="form-control" rows="2"
                                  placeholder="Quartier, rue, numéro..." required></textarea>
                    </div>
                </div>

                <h5 class="fw-bold mt-4 mb-3 border-bottom pb-2">Mode de paiement</h5>
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="border rounded p-3 text-center cursor-pointer payment-option"
                             onclick="selectPayment('wave')">
                            <input type="radio" name="payment_method" value="wave" id="wave" class="d-none" checked>
                            <img src="https://wave.com/img/wave-logo-horizontal.svg"
                                 onerror="this.src='https://via.placeholder.com/80x40?text=Wave'"
                                 height="35" class="mb-2"><br>
                            <small class="fw-semibold">Wave</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 text-center cursor-pointer payment-option"
                             onclick="selectPayment('orange_money')">
                            <input type="radio" name="payment_method" value="orange_money" id="orange_money" class="d-none">
                            <i class="bi bi-phone fs-2 text-warning d-block mb-1"></i>
                            <small class="fw-semibold">Orange Money</small>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="border rounded p-3 text-center cursor-pointer payment-option"
                             onclick="selectPayment('livraison')">
                            <input type="radio" name="payment_method" value="livraison" id="livraison" class="d-none">
                            <i class="bi bi-cash-coin fs-2 text-success d-block mb-1"></i>
                            <small class="fw-semibold">À la livraison</small>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-orange btn-lg w-100 mt-4">
                    <i class="bi bi-check-circle me-2"></i>Confirmer la commande
                </button>
            </form>
        </div>
    </div>

    <!-- RÉCAPITULATIF -->
    <div class="col-md-5">
        <div class="card shadow-sm p-4">
            <h5 class="fw-bold mb-3 border-bottom pb-2">Récapitulatif</h5>
            @php $total = 0; @endphp
            @foreach(session('cart', []) as $id => $item)
                @php $total += $item['price'] * $item['quantity']; @endphp
                <div class="d-flex justify-content-between mb-2 small">
                    <span>{{ $item['name'] }} × {{ $item['quantity'] }}</span>
                    <span class="fw-semibold">{{ number_format($item['price'] * $item['quantity'], 0, ',', ' ') }} FCFA</span>
                </div>
            @endforeach
            <hr>
            <div class="d-flex justify-content-between mb-1 small">
                <span>Sous-total</span>
                <span>{{ number_format($total, 0, ',', ' ') }} FCFA</span>
            </div>
            <div class="d-flex justify-content-between mb-1 small text-muted">
                <span>Livraison</span>
                <span>{{ $total >= 50000 ? 'Gratuite' : '2 000 FCFA' }}</span>
            </div>
            <hr>
            <div class="d-flex justify-content-between fw-bold fs-5">
                <span>Total</span>
                <span class="text-orange">
                    {{ number_format($total >= 50000 ? $total : $total + 2000, 0, ',', ' ') }} FCFA
                </span>
            </div>
        </div>
    </div>
</div>

<style>
.payment-option { cursor:pointer; transition:0.2s; }
.payment-option.selected { border-color: #ff6a00 !important; background:#fff3e0; }
</style>
<script>
function selectPayment(method){
    document.querySelectorAll('.payment-option').forEach(el => el.classList.remove('selected'));
    document.getElementById(method).checked = true;
    event.currentTarget.classList.add('selected');
}
document.querySelector('.payment-option').classList.add('selected');
</script>
@endsection
