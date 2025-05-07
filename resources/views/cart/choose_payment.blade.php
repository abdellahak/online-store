@extends('layouts.app')
@section('title', 'Choisir le mode de paiement')
@section('content')
<div class="card">
    <div class="card-header">
        Choose your payment method
    </div>
    <div class="card-body text-center">
        <p class="mb-4"><b>Montant à payer :</b> ${{ $viewData["total"] }}</p>
        <form action="{{ route('cart.purchaseOnline') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success">Online Payment</button>
        </form>
        <form action="{{ route('cart.purchaseCod') }}" method="POST" class="d-inline ms-2">
            @csrf
            <button type="submit" class="btn btn-primary">Cash on Delivery</button>
        </form>
    </div>
</div>
@endsection