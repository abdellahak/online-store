@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
  <div class="card mb-4">
    <div class="card-header">
      {{ __('messages.admin.users.create_title') }}
    </div>
    <div class="card-body">
      @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif
      @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
      @endif
      @if ($errors->any())
        <ul class="alert alert-danger list-unstyled">
          @foreach ($errors->all() as $error)
            <li>- {{ $error }}</li>
          @endforeach
        </ul>
      @endif

      <form method="POST" action="{{ route('admin.user.store') }}">
        @csrf
        <div class="row">
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.users.form.name') }}</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="name" value="{{ old('name') }}" type="text" class="form-control">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.users.form.email') }}</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="email" value="{{ old('email') }}" type="email" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.users.form.password') }}</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="password" type="password" class="form-control">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.users.form.password_confirmation') }}</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="password_confirmation" type="password" class="form-control">
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.users.form.balance') }}</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="balance" value="{{ old('balance', 0) }}" type="number" class="form-control">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.users.form.role') }}</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <select name="role" class="form-control" id="roleSelect">
                  <option value="client" {{ old('role') == 'client' ? 'selected' : '' }}>{{ __('messages.admin.users.table.role') }}</option>
                  <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>{{ __('messages.admin.users.table.super_admin') }}</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="mb-3 row align-items-end">
              <div class="col-lg-10 col-md-6 col-sm-12">
                <div class="form-check form-switch">
                  <input type="checkbox" name="is_super_admin" value="1" id="isSuperAdminCheckbox"
                    {{ old('is_super_admin') ? 'checked' : '' }} class="form-check-input" role="switch">
                  <label class="form-check-label" for="isSuperAdminCheckbox">{{ __('messages.admin.users.form.is_super_admin') }}</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.admin.users.form.submit') }}</button>
      </form>
    </div>
  </div>

  <div class="card">
    <div class="card-header">
      {{ __('messages.admin.users.manage_title') }}
    </div>
    <div class="card-body">
      <table class="table table-bordered table-striped">
        <thead>
          <tr>
            <th scope="col">{{ __('messages.admin.users.table.id') }}</th>
            <th scope="col">{{ __('messages.admin.users.table.name') }}</th>
            <th scope="col">{{ __('messages.admin.users.table.email') }}</th>
            <th scope="col">{{ __('messages.admin.users.table.role') }}</th>
            <th scope="col">{{ __('messages.admin.users.table.super_admin') }}</th>
            <th scope="col">{{ __('messages.admin.users.table.balance') }}</th>
            <th scope="col">{{ __('messages.admin.users.table.edit') }}</th>
            <th scope="col">{{ __('messages.admin.users.table.delete') }}</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($viewData['users'] as $user)
            <tr>
              <td>{{ $user->getId() }}</td>
              <td>{{ $user->getName() }}</td>
              <td>{{ $user->getEmail() }}</td>
              <td>{{ $user->getRole() }}</td>
              <td>{{ $user->getIsSuperAdmin() ? __('messages.admin.users.yes') : __('messages.admin.users.no') }}</td>
              <td>${{ $user->getBalance() }}</td>
              <td>
                <a class="btn btn-primary" href="{{ route('admin.user.edit', ['id' => $user->getId()]) }}">
                  <i class="bi-pencil"></i>
                </a>
              </td>
              <td>
                <form action="{{ route('admin.user.delete', $user->getId()) }}" method="POST">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" onclick="return confirm('{{ __('messages.admin.users.delete_confirm') }}');">
                    <i class="bi-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
      {{-- Custom pagination for users --}}
      @if ($viewData['users']->count())
        <div class="d-flex flex-column align-items-center mt-4">
          @php
            $paginator = $viewData['users'];
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
            {{ __('messages.admin.users.pagination.showing') }}
            <strong>{{ $paginator->firstItem() ?? 0 }}</strong>
            {{ __('messages.admin.users.pagination.to') }}
            <strong>{{ $paginator->lastItem() ?? 0 }}</strong>
            {{ __('messages.admin.users.pagination.of') }}
            <strong>{{ $paginator->total() }}</strong>
            {{ __('messages.admin.users.pagination.users') }}
            ({{ __('messages.admin.users.pagination.page') }} <strong>{{ $paginator->currentPage() }}</strong> {{ __('messages.admin.users.pagination.of2') }} <strong>{{ $paginator->lastPage() }}</strong>)
          </div>
        </div>
      @endif
    </div>
  </div>
@endsection

@push('styles')
  <style>
    #isSuperAdminCheckbox {
      width: 3em;
      height: 1.5em;
      cursor: pointer;
    }

    label[for="isSuperAdminCheckbox"] {
      padding-left: 0.5em;
      vertical-align: middle;
    }
  </style>
@endpush

@push('scripts')
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      const roleSelect = document.getElementById('roleSelect');
      const superAdminCheckbox = document.getElementById('isSuperAdminCheckbox');

      function toggleSuperAdminCheckbox() {
        if (roleSelect.value === 'client') {
          superAdminCheckbox.disabled = true;
          superAdminCheckbox.checked = false;
        } else {
          superAdminCheckbox.disabled = false;
        }
      }

      toggleSuperAdminCheckbox();

      roleSelect.addEventListener('change', toggleSuperAdminCheckbox);
    });
  </script>
@endpush
