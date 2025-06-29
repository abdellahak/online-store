@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')

  @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ session('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  <div class="card mb-3">
    <div class="row g-0">
      <div class="col-md-4">
        <img src="{{ asset('/storage/' . $viewData['product']->getImage()) }}" class="img-fluid rounded-start">
      </div>
      <div class="col-md-8">
        <div class="card-body">
          <h5 class="card-title">
            @php
              $solde = $viewData['product']->getDiscountedPrice();
              $hassolde =$solde < $viewData['product']->getPrice();


          
            @endphp
            @if ($hassolde)

              <span class="text-decoration-line-through">${{ $viewData['product']->getPrice() }}</span>
            {{ $viewData['product']->getName() }} (${{ $solde }}) <span class="badge bg-danger">Sale</span>
            @else
              {{ $viewData['product']->getName() }} (${{ $viewData['product']->getPrice() }})
            @endif
          </h5>

          <p class="card-text">{{ $viewData['product']->getDescription() }}</p>
          <p class="card-text">{{ __('messages.products.show.details.stock') }} {{ $viewData['product']->getQuantityStore() }}</p>
          <p class="card-text">
          <p class="card-text">
          <form method="POST" action="{{ route('cart.add', ['id' => $viewData['product']->getId()]) }}">
            <div class="row">
              @csrf
              <div class="col-auto">
                <div class="input-group col-auto">
                  <div class="input-group-text">{{ __('messages.products.show.details.add_to_cart.quantity') }}</div>
                  <input type="number" min="1" max="10" class="form-control quantity-input" name="quantity"
                    value="1">
                </div>
              </div>
              <div class="col-auto">
                  <button class="btn bg-primary text-white" type="submit">
                    {{ __('messages.products.show.details.add_to_cart.add') }}
                  </button>
              </div>
            </div>
          </form>
          </p>
        </div>
      </div>
    </div>
  </div>
@endsection
