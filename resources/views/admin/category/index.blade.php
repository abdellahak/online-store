@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
  <div class="card mb-4">
    <div class="card-header">
      Create category
    </div>
    <div class="card-body">
      @if ($errors->any())
        <ul class="alert alert-danger list-unstyled">
          @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
          @endforeach
        </ul>
      @endif

      <form method="POST" action="{{ route('admin.category.store') }}" enctype="multipart/form-data">
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

        </div>

        <div class="mb-3">
          <label class="form-label">Description</label>
          <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      Manage Categories
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
            <th scope="col">Edit</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($viewData['categories'] as $category)
            <tr>
              <td>{{ $category->id }}</td>
              <td>{{ $category->name }}</td>
              <td>{{ $category->description }}</td>
              <td>
                <a class="btn btn-primary" href="{{ route('admin.category.edit', ['id' => $category->id]) }}">
                  <i class="bi-pencil"></i>
                </a>
              </td>
              <td>
                <form action="{{ route('admin.category.destroy', $category->id) }}" method="POST">
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
      @if ($viewData['categories']->count())
        <div class="d-flex flex-column align-items-center mt-4">
          @php
            $paginator = $viewData['categories'];
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
            categories
            (Page <strong>{{ $paginator->currentPage() }}</strong> of <strong>{{ $paginator->lastPage() }}</strong>)
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection
