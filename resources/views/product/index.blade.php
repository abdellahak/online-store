@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
<div class="row">
  @foreach ($viewData["products"] as $product)
  <div class="col-md-4 col-lg-3 mb-2">
    <div class="card">
      <img src="{{ asset('/storage/'.$product->getImage()) }}" class="card-img-top img-card">
      <div class="card-body text-center">
        <a href="{{ route('product.show', ['id'=> $product->getId()]) }}"
          class="btn bg-primary text-white">{{ $product->getName() }}</a>
        <div class="mt-2">
          @if($product->getQuantityStore() > 0)
            <span class="badge bg-success">{{ $product->getQuantityStore() }} still in stock</span>
          @else
            <span class="badge bg-danger">Out of stock</span>
          @endif
        </div>
      </div>
    </div>
  </div>
  @endforeach
</div>
@endsection
