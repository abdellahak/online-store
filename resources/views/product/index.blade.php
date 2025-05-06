@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')

  <div class="row">
    @foreach ($viewData['products'] as $product)
      <div class="col-md-4 col-lg-3 mb-2">
        <div class="card">
          <img src="{{ asset('/storage/' . $product->getImage()) }}" class="card-img-top img-card">
          <div class="card-body text-center d-flex flex-column justify-content-between">
            <a href="{{ route('product.show', ['id' => $product->getId()]) }}"
              class="btn text-white {{ $product->getQuantityStore() == 0 ? 'bg-danger' : 'bg-primary' }}">
                {{ $product->getName() }}
                @if ($product->getQuantityStore() == 0)
                <span class="text-white ms-2 small">(Out of stock)</span>
                @endif
            </a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
@endsection
