@extends('layouts.admin')
@section('title', __('messages.admin.soldes.edit.title'))
@section('content')
<div class="card mb-4">
  <div class="card-header">{{ __('messages.admin.soldes.edit.title') }}</div>
  <div class="card-body">
    @if ($errors->any())
      <ul class="alert alert-danger list-unstyled">
        @foreach ($errors->all() as $error)
          <li>- {{ $error }}</li>
        @endforeach
      </ul>
    @endif
    <form method="POST" action="{{ route('admin.soldes.update', $solde->id) }}">
      @csrf
      @method('PUT')
      <div class="mb-3">
        <label>{{ __('messages.admin.soldes.edit.value') }}</label>
        <input type="number" name="value" value="{{ old('value', $solde->value) }}" class="form-control">
      </div>
      <div class="mb-3">
        <label>{{ __('messages.admin.soldes.edit.starts_at') }}</label>
        <input type="date" name="starts_at" value="{{ old('starts_at', $solde->starts_at) }}" class="form-control">
      </div>
      <div class="mb-3">
        <label>{{ __('messages.admin.soldes.edit.ends_at') }}</label>
        <input type="date" name="ends_at" value="{{ old('ends_at', $solde->ends_at) }}" class="form-control">
      </div>
      <div class="mb-3">
        <label>{{ __('messages.admin.soldes.edit.product') }}</label>
        <select name="product_id" class="form-control">
          <option value="">{{ __('messages.admin.soldes.edit.select_product') }}</option>
          @foreach ($products as $product)
            <option value="{{ $product->id }}" {{ $solde->product_id == $product->id ? 'selected' : '' }}>
              {{ $product->name }}
            </option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <label>{{ __('messages.admin.soldes.edit.category') }}</label>
        <select name="category_id" class="form-control">
          <option value="">{{ __('messages.admin.soldes.edit.select_category') }}</option>
          @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ $solde->category_id == $category->id ? 'selected' : '' }}>
              {{ $category->name }}
            </option>
          @endforeach
        </select>
      </div>
      <button type="submit" class="btn btn-success">{{ __('messages.admin.soldes.edit.btn') }}</button>
    </form>
  </div>
</div>
@endsection
