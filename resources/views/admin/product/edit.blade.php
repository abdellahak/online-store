@extends('layouts.admin')
@section('title', $viewData["title"])
@section('content')
<div class="card mb-4">
  <div class="card-header">
    {{ __('messages.admin.product.edit.title') }}
  </div>
  <div class="card-body">
    @if($errors->any())
    <ul class="alert alert-danger list-unstyled">
      @foreach($errors->all() as $error)
      <li>- {{ $error }}</li>
      @endforeach
    </ul>
    @endif

    <form method="POST" action="{{ route('admin.product.update', ['id'=> $viewData['product']->getId()]) }}"
      enctype="multipart/form-data">
      @csrf
      @method('PUT')
      <div class="row">
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.product.edit.form.name') }}</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="name" value="{{ $viewData['product']->getName() }}" type="text" class="form-control">
            </div>
          </div>
        </div>
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.product.edit.form.price') }}</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="price" value="{{ $viewData['product']->getPrice() }}" type="number" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.product.edit.form.image') }}</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input class="form-control" type="file" name="image">
            </div>
          </div>
        </div>
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.product.edit.form.quantity') }}</label>
            <div class="col-lg-10 col-md-6 col-sm-12">
              <input name="quantity_store" value="{{ $viewData['product']->getQuantityStore() }}" type="number" class="form-control">
            </div>
          </div>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.product.edit.form.category') }}</label>
          <select name="category_id" class="col-lg-10 col-md-6 col-sm-12">
            <option value="" disabled {{ old('category_id', $viewData["product"]->category_id) ? '' : 'selected' }}>
                {{ __('messages.admin.product.edit.form.category') }}
            </option>
            @foreach ($viewData["categories"] as $category)
                <option value="{{ $category->id }}"
                    {{ old('category_id', $viewData["product"]->category_id) == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        </div>
      </div>
      <div class="col">
        <div class="mb-3 row">
          <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.product.edit.form.supplier') }}</label>
          <select name="supplier_id" class="col-lg-10 col-md-6 col-sm-12">
            <option value="" disabled {{ old('supplier_id', $viewData["product"]->supplier_id) ? '' : 'selected' }}>
                {{ __('messages.admin.product.edit.form.supplier') }}
            </option>
            @foreach ($viewData["suppliers"] as $supplier)
                <option value="{{ $supplier->id }}"
                    {{ old('supplier_id', $viewData["product"]->supplier_id) == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->raison_sociale }}
                </option>
            @endforeach
        </select>
        </div>
      </div>
      <div class="mb-3">
        <label class="form-label">{{ __('messages.admin.product.edit.form.description') }}</label>
        <textarea class="form-control" name="description"
          rows="3">{{ $viewData['product']->getDescription() }}</textarea>
      </div>
      <button type="submit" class="btn btn-primary">{{ __('messages.admin.product.edit.form.btn_update') }}</button>
    </form>
  </div>
</div>
@endsection
