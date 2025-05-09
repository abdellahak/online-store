@extends('layouts.app')
@section('title', $viewData['title'])
@section('subtitle', $viewData['subtitle'])
@section('content')

  <div class="row">

    <div>
      <form method="GET" action="{{ route('product.index') }}">

        <div class="form-check form-switch">
          <input type="checkbox" name="show_sales" id="showSales" {{ old('show_sales') ? 'checked' : '' }}
            class="form-check-input" role="switch" {{ request('show_sales') ? 'checked' : '' }}
            onchange="this.form.submit()">
          <label class="form-check-label" for="showSales">Show Only Sales</label>
        </div>
      </form>

    </div>

    @if ($viewData['products']->isEmpty())
      <div class="col-12 d-flex justify-content-center align-items-center" style="height: 350px;">
        <div class="text-center p-5 rounded" >
          <div style="font-size: 3rem; color: #6c757d;">
            <i class="bi bi-box-seam"></i>
          </div>
          <h3 class="mt-3 mb-2" style="color: #495057;">No Products Found</h3>
          <p class="mb-0 text-muted">Try adjusting your filters or check back later!</p>
        </div>
      </div>
    @else
      @foreach ($viewData['products'] as $product)
        <div class="col-md-4 col-lg-3 mb-2">
          <div class="card">
            <img src="{{ asset('storage/' . $product->getImage()) }}" class="card-img-top img-card">
            <div class="card-body text-center d-flex flex-column justify-content-between">
              <a href="{{ route('product.show', ['id' => $product->getId()]) }}"
                class="btn text-white {{ $product->getQuantityStore() == 0 ? 'bg-danger' : 'bg-primary' }}">
                {{ $product->getName() }}
                @if ($product->getQuantityStore() == 0)
                  <span class="text-white ms-2 small">(Out of stock)</span>
                @endif
              </a>
              <div class="mt-2">
                @if ($product->hasSoldes())
                  <span
                    class="text-decoration-line-through text-muted">${{ number_format($product->getPrice(), 2) }}</span>
                  <strong class="text-danger ms-1">${{ number_format($product->getDiscountedPrice(), 2) }}</strong>
                @else
                  <strong>${{ number_format($product->getPrice(), 2) }}</strong>
                @endif
              </div>
            </div>
          </div>
        </div>
      @endforeach
    @endif
  </div>
@endsection
@push('styles')
  <style>
    #showSales {
      width: 3em;
      height: 1.5em;
      cursor: pointer;
    }

    label[for="showSales"] {
      padding-left: 0.5em;
      vertical-align: middle;
    }
  </style>
@endpush
