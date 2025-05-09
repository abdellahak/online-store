@extends('layouts.admin')
@section('title', $viewData['title'])
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

      <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Name:</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="name" value="{{ old('name') }}" type="text" class="form-control">
              </div>
            </div>
          </div>

          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Price:</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="price" value="{{ old('price') }}" type="number" class="form-control">
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Image:</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input class="form-control" type="file" name="image">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="col">
              <div class="mb-3 row">
                <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Quantity:</label>
                <div class="col-lg-10 col-md-6 col-sm-12">
                  <input name="quantity_store" value="{{ old('quantity_store') }}" type="number" class="form-control">
                </div>
              </div>
            </div>
          </div>
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
        <div class="col">
          <div class="mb-3 row">
            <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">Supplier Name</label>
            <select name="supplier_id" id="" class="form-control">
              <option value="" disabled selected>Select Supplier</option>
              @foreach ($viewData['suppliers'] as $supplier)
                <option value="{{ $supplier->id }}">{{ $supplier->raison_sociale }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>

  <div class="d-flex align-items-center gap-2">
    <a href="{{ route('admin.product.export') }}" class="btn btn-success mb-2">Exporter CSV</a>
    <form action="{{ route('admin.product.import') }}" method="POST" enctype="multipart/form-data"
      style="display:inline;">
      @csrf
      <button type="submit" class="btn btn-primary mb-2">Importer CSV</button>
      <input type="file" class="mb-2" name="csv_file" accept=".csv" required>
    </form>
  </div>

  <div class="card">
    <div class="card-header">
      Manage Products
    </div>
    <div class="card-body">
      <form method="GET" action="{{ route('admin.product.filterparcategory') }}">
        <div class="mb-3">
          <label class="form-label">Filter by Category:</label>
          <select name="category_id" class="form-control" onchange="this.form.submit()">
            <option value="">All Categories</option>
            @foreach ($viewData['categories'] as $category)
              <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
              </option>
            @endforeach
          </select>
        </div>
      </form>
      <form method="GET" action="{{ route('admin.product.filterparsupplier') }}">
        <div class="mb-3">
          <label class="form-label">Filter by Supplier:</label>
          <select name="supplier_id" class="form-control" onchange="this.form.submit()">
            <option value="">All Supplier</option>
            @foreach ($viewData['suppliers'] as $supplier)
              <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
                {{ $supplier->raison_sociale }}
              </option>
            @endforeach
          </select>
        </div>
      </form>
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Category Name</th>
            <th scope="col">Supplier Name</th>
            <th scope="col">Price</th>
            <th scope="col">Discounted Price</th>
            <th scope="col">Quantity</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($viewData['products'] as $product)
            @php
              $quantity = $product->getQuantityStore();
              $bgColor = '';
              if ($quantity == 0) {
                  $bgColor = 'bg-danger text-white';
              } elseif ($quantity < 10) {
                  $bgColor = 'bg-warning';
              } else {
                  $bgColor = 'bg-success text-white';
              }
            @endphp
            <tr class="{{ $bgColor }}">
              <td>{{ $product->getId() }}</td>
              <td>{{ $product->getName() }}</td>
              <td>{{ $product->category->name }}</td>
              <td>{{ $product->supplier?->raison_sociale }}</td>
              <td>${{ $product->getPrice() }}</td>
              <td>${{ $product->getDiscountedPrice() }}</td>
              <td>{{ $product->getQuantityStore() }}</td>
              <td>
                <a class="btn btn-primary"
                  href="{{ route('admin.product.edit', ['id' => $product->getId(), 'category_id' => $product->category->id]) }}">
                  <i class="bi-pencil"></i>
                </a>
              </td>
              <td>
                <form action="{{ route('admin.product.delete', $product->getId()) }}" method="POST">
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
      @if ($viewData['products']->count())
        <div class="d-flex flex-column align-items-center mt-4">
          @php
            $paginator = $viewData['products'];
          @endphp

          <nav>
            <ul class="pagination">
              @if ($paginator->onFirstPage())
                <li class="page-item disabled"><span class="page-link">&laquo;</span></li>
              @else
                <li class="page-item">
                  <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a>
                </li>
              @endif

              @foreach ($paginator->getUrlRange(1, $paginator->lastPage()) as $page => $url)
                @if ($page == $paginator->currentPage())
                  <li class="page-item active"><span class="page-link">{{ $page }}</span></li>
                @else
                  <li class="page-item"><a class="page-link" href="{{ $url }}">{{ $page }}</a></li>
                @endif
              @endforeach

              @if ($paginator->hasMorePages())
                <li class="page-item">
                  <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a>
                </li>
              @else
                <li class="page-item disabled"><span class="page-link">&raquo;</span></li>
              @endif
            </ul>
          </nav>
          <div class="mb-2 text-muted small">
            Showing
            <strong>{{ $paginator->firstItem() ?? 0 }}</strong>
            to
            <strong>{{ $paginator->lastItem() ?? 0 }}</strong>
            of
            <strong>{{ $paginator->total() }}</strong>
            products
            (Page <strong>{{ $paginator->currentPage() }}</strong> of <strong>{{ $paginator->lastPage() }}</strong>)
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection
