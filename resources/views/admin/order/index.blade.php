@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')

  <div class="card">
    <div class="card-header">
      Manage Orders
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Total</th>
            <th scope="col">User Name</th>
            <th scope="col">Status</th>
            <th scope="col">Payment Type</th>
            <th scope="col">Delete</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($viewData['orders'] as $order)
            <tr>
              <td>{{ $order->getId() }}</td>
              <td>{{ $order->getTotal() }}</td>
              <td>{{ $order->user->name }}</td>
              <td>
                <form method="POST" action="{{ route('admin.order.update', ['id' => $order->getId()]) }}">
                  @csrf
                  @method('PUT')
                  <div class="mb-3">

                    <select name="status" class="form-control" onchange="this.form.submit()">
                      @foreach (['Emballé', 'Envoyé', 'En route', 'Recu', 'Retournée', 'fermée'] as $status)
                        <option value="{{ $status }}"
                          {{ old('status', $order->status ?? '') == $status ? 'selected' : '' }}>
                          {{ $status }}
                        </option>
                      @endforeach
                    </select>
                  </div>
                </form>
              </td>
              <td>
                @if ($order->getPaymentType() == 'cod')
                  Cash on Delivery
                @else
                  Paid
                @endif
              </td>
              <td>
                <form action="{{ route('admin.order.destroy', $order->getId()) }}" method="POST">
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
      @if ($viewData['orders']->count())
        <div class="d-flex flex-column align-items-center mt-4">
          @php
            $paginator = $viewData['orders'];
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
            orders
            (Page <strong>{{ $paginator->currentPage() }}</strong> of <strong>{{ $paginator->lastPage() }}</strong>)
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection
