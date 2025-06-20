@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
  <div class="card mb-4">
    <div class="card-header">
      {{__('messages.admin.suppliers.create.title')}}
    </div>
    <div class="card-body">
      @if ($errors->any())
        <ul class="alert alert-danger list-unstyled">
          @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
          @endforeach
        </ul>
      @endif

      <form method="POST" action="{{ route('admin.supplier.store') }}" enctype="multipart/form-data">
        @csrf
        <div class="row">
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.admin.suppliers.create.raison_social')}}:</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="raison_sociale" value="{{ old('raison_sociale') }}" type="text" class="form-control">
              </div>
            </div>
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.admin.suppliers.create.address')}}:</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="adresse" value="{{ old('adresse') }}" type="text" class="form-control">
              </div>
            </div>
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.admin.suppliers.create.telephone')}}:</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="tele" value="{{ old('tele') }}" type="text" class="form-control">
              </div>
            </div>
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{__('messages.admin.suppliers.create.email')}}:</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="email" value="{{ old('email') }}" type="email" class="form-control">
              </div>
            </div>
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">{{__('messages.admin.suppliers.create.description')}}</label>
          <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      Manage Suppliers
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">{{__('messages.admin.suppliers.create.raison_social')}}</th>
            <th scope="col">{{__('messages.admin.suppliers.create.address')}}</th>
            <th scope="col">{{__('messages.admin.suppliers.create.telephone')}}</th>
            <th scope="col">{{__('messages.admin.suppliers.create.email')}}</th>
            <th scope="col">{{__('messages.admin.suppliers.create.description')}}</th>
            <th scope="col">{{__('messages.admin.suppliers.create.btn_up')}}</th>
            <th scope="col">{{__('messages.admin.suppliers.create.btn_de')}}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($viewData['suppliers'] as $supplier)
            <tr>
              <td>{{ $supplier->id }}</td>
              <td>{{ $supplier->raison_sociale }}</td>
              <td>{{ $supplier->adresse }}</td>
              <td>{{ $supplier->tele }}</td>
              <td>{{ $supplier->email }}</td>
              <td>{{ $supplier->description }}</td>
              <td>
                <a class="btn btn-primary" href="{{ route('admin.supplier.edit', ['id' => $supplier->id]) }}">
                  <i class="bi-pencil"></i>
                </a>
              </td>
              <td>
                <form action="{{ route('admin.supplier.destroy', $supplier->id) }}" method="POST">
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
      @if ($viewData['suppliers']->count())
        <div class="d-flex flex-column align-items-center mt-4">
          @php
            $paginator = $viewData['suppliers'];
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
            suppliers
            (Page <strong>{{ $paginator->currentPage() }}</strong> of <strong>{{ $paginator->lastPage() }}</strong>)
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection
