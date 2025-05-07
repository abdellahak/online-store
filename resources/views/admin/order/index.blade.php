@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
  
<div class="card">
  <div class="card-header">
    Manage Orders
  </div>
  <div class="card-body">
    {{-- <form method="GET" action="{{ route('admin.product.filterparcategory') }}">
      <div class="mb-3">
        <label class="form-label">Filter by Category:</label>
        <select name="category_id" class="form-control" onchange="this.form.submit()">
          <option value="">All Categories</option>
          @foreach ($viewData["categories"] as $category)
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
          @foreach ($viewData["suppliers"] as $supplier)
          <option value="{{ $supplier->id }}" {{ request('supplier_id') == $supplier->id ? 'selected' : '' }}>
            {{ $supplier->raison_sociale }}
          </option>
          @endforeach
        </select>
      </div>
    </form> --}}
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Total</th>
          <th scope="col">User Name</th>
          <th scope="col">Status</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($viewData["orders"] as $order)
        {{-- @php
              $quantity = $product->getQuantityStore();
              $bgColor = '';
              if ($quantity == 0) {
                  $bgColor = 'bg-danger text-white';
              } elseif ($quantity < 10) {
                  $bgColor = 'bg-warning';    
              } else {
                  $bgColor = 'bg-success text-white';
              }
            @endphp --}}
        <tr >
            <td>{{ $order->getId() }}</td>
            <td>{{ $order->getTotal() }}</td>
            <td>{{ $order->user->name}}</td>
            <td>
                <form method="POST" action="{{ route('admin.order.update',['id' => $order->getId()])  }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                      
                        <select name="status" class="form-control" onchange="this.form.submit()">
                            @foreach (["Emballé","Envoyé","En route","Recu","Retournée","fermée"] as $status)
                                <option value="{{ $status }}" {{ old('status', $order->status ?? '') == $status ? 'selected' : '' }}>
                                    {{ $status }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                  </form>
            </td>
            <td>
              <form action="{{ route('admin.order.destroy', $order->getId())}}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">
                  Delete
                </button>
              </form>

        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
@endsection
