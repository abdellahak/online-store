@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="card">
  <div class="card-header">
    Products in Cart
  </div>
  <div class="card-body">
    <div class="mb-3">
      <h5 class="text-primary">Your Balance:</h5>
      <p class="fs-5 text-success"><b>${{ number_format($viewData["user"]->balance, 2) }}</b></p>
    </div>
    <table class="table table-bordered table-striped text-center">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Price</th>
          <th scope="col">Quantity</th>
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
        <a class="btn btn-outline-secondary mb-2"><b>Total to pay:</b> ${{ $viewData["total"] }}</a>
        @if (count($viewData["products"]) > 0)
        <a href="{{ route('cart.choosePayment') }}" class="btn bg-primary text-white mb-2">Purchase</a>
        <a href="{{ route('cart.delete') }}">
          <button class="btn btn-danger mb-2">
            Remove all products from Cart
          </button>
        </a>
        @endif
      </div>
    </div>
  </div>
</div>
@endsection
