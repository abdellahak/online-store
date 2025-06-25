@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
  <div class="card">
    <div class="card-header">
      {{ __('messages.admin.orders.manage_title') }}
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">{{ __('messages.admin.orders.table.id') }}</th>
            <th scope="col">{{ __('messages.admin.orders.table.total') }}</th>
            <th scope="col">{{ __('messages.admin.orders.table.user') }}</th>
            <th scope="col">{{ __('messages.admin.orders.table.status') }}</th>
            <th scope="col">{{ __('messages.admin.orders.table.payment_type') }}</th>
            <th scope="col">{{ __('messages.admin.orders.table.delete') }}</th>
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
                      <option value="{{ __('messages.admin.orders.status_options.packed') }}" {{ old('status', $order->status ?? '') == __('messages.admin.orders.status_options.packed') ? 'selected' : '' }}>{{ __('messages.admin.orders.status_options.packed') }}</option>
                      <option value="{{ __('messages.admin.orders.status_options.sent') }}" {{ old('status', $order->status ?? '') == __('messages.admin.orders.status_options.sent') ? 'selected' : '' }}>{{ __('messages.admin.orders.status_options.sent') }}</option>
                      <option value="{{ __('messages.admin.orders.status_options.on_way') }}" {{ old('status', $order->status ?? '') == __('messages.admin.orders.status_options.on_way') ? 'selected' : '' }}>{{ __('messages.admin.orders.status_options.on_way') }}</option>
                      <option value="{{ __('messages.admin.orders.status_options.received') }}" {{ old('status', $order->status ?? '') == __('messages.admin.orders.status_options.received') ? 'selected' : '' }}>{{ __('messages.admin.orders.status_options.received') }}</option>
                      <option value="{{ __('messages.admin.orders.status_options.returned') }}" {{ old('status', $order->status ?? '') == __('messages.admin.orders.status_options.returned') ? 'selected' : '' }}>{{ __('messages.admin.orders.status_options.returned') }}</option>
                      <option value="{{ __('messages.admin.orders.status_options.closed') }}" {{ old('status', $order->status ?? '') == __('messages.admin.orders.status_options.closed') ? 'selected' : '' }}>{{ __('messages.admin.orders.status_options.closed') }}</option>
                    </select>
                  </div>
                </form>
              </td>
              <td>
                @if ($order->getPaymentType() == 'cod')
                  {{ __('messages.admin.orders.payment.cod') }}
                @else
                  {{ __('messages.admin.orders.payment.paid') }}
                @endif
              </td>
              <td>
                <form action="{{ route('admin.order.destroy', $order->getId()) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger">
                    {{ __('messages.admin.orders.btn_delete') }}
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
            {{ __('messages.admin.orders.pagination.showing') }}
            <strong>{{ $paginator->firstItem() ?? 0 }}</strong>
            {{ __('messages.admin.orders.pagination.to') }}
            <strong>{{ $paginator->lastItem() ?? 0 }}</strong>
            {{ __('messages.admin.orders.pagination.of') }}
            <strong>{{ $paginator->total() }}</strong>
            {{ __('messages.admin.orders.pagination.orders') }}
            ({{ __('messages.admin.orders.pagination.page') }} <strong>{{ $paginator->currentPage() }}</strong> {{ __('messages.admin.orders.pagination.of2') }} <strong>{{ $paginator->lastPage() }}</strong>)
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection
