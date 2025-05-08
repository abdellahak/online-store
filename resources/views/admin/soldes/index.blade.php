@extends('layouts.admin')
@section('title', 'Manage Soldes')
@section('content')
<div class="card mb-4">
    <div class="card-header">
      Create Products
    </div>
    <div class="card-body">
      @if ($errors->any())
        <ul class="alert alert-danger list-unstyled">
          @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
          @endforeach
        </ul>
      @endif

      <form method="POST" action="{{ route('admin.soldes.store') }}">
        @csrf
        <div class="row">
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">value:</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="value" value="{{ old('value') }}" type="text" class="form-control">
              </div>
            </div>
          </div>

          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">starts_at:</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="starts_at" value="{{ old('starts_at') }}" type="date" class="form-control">
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">ends_at:</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="ends_at" value="{{ old('ends_at') }}" type="date" class="form-control">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Product Name</label>
              <select name="product_id" id="" class="form-control">
                <option value="" disabled selected>Select Product</option>
                
                @foreach ($viewData['products'] as $product)
                  <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
              </select>
            </div>
        <div class="row">

          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Category Name</label>
              <select name="category_id" id="" class="form-control">
                <option value="" disabled selected>Select Category</option>
                @foreach ($viewData['categories'] as $category)
                  <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
              </select>
            </div>
          </div>
        </div>
      
      
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>


















<div class="card mb-4">
  <div class="card-header">
    Manage Soldes
  </div>
  <div class="card-body">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Product</th>
          <th scope="col">Category</th>
          <th scope="col">Discount (%)</th>
          <th scope="col">Start Date</th>
          <th scope="col">End Date</th>
          <th scope="col">Edit</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($viewData["soldes"] as $solde)
        <tr>
          <td>{{ $solde->id }}</td>
          <td>{{ $solde->product ? $solde->product->name : 'N/A' }}</td>
          <td>{{ $solde->category ? $solde->category->name : 'N/A' }}</td>
          <td>{{ $solde->value }}</td>
          <td>{{ $solde->starts_at }}</td>
          <td>{{ $solde->ends_at }}</td>
          <td>
            <a class="btn btn-primary" href="{{ route('admin.soldes.edit', ['id' => $solde->id]) }}">
              <i class="bi-pencil"></i>
            </a>
          </td>
          <td>
            <form action="{{ route('admin.soldes.destroy', $solde->id) }}" method="POST">
              @csrf
              @method('DELETE')
              <button class="btn btn-danger">
                <i class="bi-trash"></i>
              </button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
