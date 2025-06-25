@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="card">
  <div class="card-header">
    {{ __('messages.cart.index.title') }}
  </div>
  <div class="card-body">
    @if($viewData["user"])
    <div class="mb-3">
      <h5 class="text-primary">{{ __('messages.cart.index.balance') }}:</h5>
      <p class="fs-5 text-success"><b>${{ number_format($viewData["user"]->balance, 2) }}</b></p>
    </div>
    @endif
    <table class="table table-bordered table-striped text-center">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">{{ __('messages.cart.index.table.headers.name') }}</th>
          <th scope="col">{{ __('messages.cart.index.table.headers.price') }}</th>
          <th scope="col">{{ __('messages.cart.index.table.headers.quantity') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($viewData["products"] as $product)
        <tr>
          <td>{{ $product->getId() }}</td>
          <td>{{ $product->getName() }}</td>
          <td>${{ $product->getDiscountedPrice() }}</td>
          <td>{{ json_decode(Cookie::get('cart'), true)[$product->getId()]}}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <div class="row">
      <div class="text-end">
        <a class="btn btn-outline-secondary mb-2"><b>{{ __('messages.cart.index.content.total') }} ${{ $viewData["total"] }}</a>
        @if (count($viewData["products"]) > 0)
        <a href="{{ route('cart.choosePayment') }}" class="btn bg-primary text-white mb-2">{{ __('messages.cart.index.content.proceed') }}</a>
        <a href="{{ route('cart.delete') }}">
          <button class="btn btn-danger mb-2">
            {{ __('messages.cart.index.content.clear') }}
          </button>
        </a>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
