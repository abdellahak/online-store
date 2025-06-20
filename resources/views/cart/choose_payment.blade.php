@extends('layouts.app')
@section('title', 'Choisir le mode de paiement')
@section('content')
  <div class="card">
    @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="card-header">
      {{ __('messages.cart.choose-payment.title') }}
    </div>
    <div class="card-body text-center">
      <p class="mb-4"><b>{{ __('messages.cart.choose-payment.amount') }}:</b> ${{ $viewData['total'] }}</p>
      <form action="{{ route('cart.purchaseOnline') }}" method="POST" class="d-inline">
        @csrf
        <button type="submit" class="btn btn-success">{{ __('messages.cart.choose-payment.online') }}</button>
      </form>
      <form action="{{ route('cart.purchaseCod') }}" method="POST" class="d-inline ms-2">
        @csrf
        <button type="submit" class="btn btn-primary">{{ __('messages.cart.choose-payment.cash') }}</button>
      </form>
    </div>
  </div>
@endsection
