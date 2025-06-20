@extends('layouts.app')
@section('title', $viewData["title"])
@section('subtitle', $viewData["subtitle"])
@section('content')
@forelse ($viewData["orders"] as $order)
<div class="card mb-4">
  <div class="card-header">
    Order #{{ $order->getId() }}
  </div>
  <div class="card-body">
    <b>{{ __('messages.admin.product.index.orders.date') }}:</b> {{ $order->getCreatedAt() }}<br />
    <b>{{ __('messages.admin.product.index.orders.total') }}:</b> ${{ $order->getTotal() }}<br />
    <table class="table table-bordered table-striped text-center mt-3">
      <thead>
        <tr>
          <th scope="col">{{ __('messages.admin.product.index.orders.id') }}</th>
          <th scope="col">{{ __('messages.admin.product.index.orders.name') }}</th>
          <th scope="col">{{ __('messages.admin.product.index.orders.price') }}</th>
          <th scope="col">{{ __('messages.admin.product.index.orders.quantity') }}</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($order->getItems() as $item)
        <tr>
          <td>{{ $item->getId() }}</td>
          <td>
            <a class="link-success" href="{{ route('product.show', ['id'=> $item->getProduct()->getId()]) }}">
              {{ $item->getProduct()->getName() }}
            </a>
          </td>
          <td>${{ $item->getPrice() }}</td>
          <td>{{ $item->getQuantity() }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@empty
<div class="alert alert-danger" role="alert">
  Seems to be that you have not purchased anything in our store =(.
</div>
@endforelse
@endsection
