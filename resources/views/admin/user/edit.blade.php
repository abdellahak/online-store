@extends('layouts.admin')
@section('title', $viewData['title'])
@section('content')
  <div class="card mb-4">
    <div class="card-header">
      {{ __('messages.admin.users.edit_title') }}
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

      <form method="POST" action="{{ route('admin.user.update', ['id' => $viewData['user']->getId()]) }}">
        @csrf
        @method('PUT')
        <div class="row">
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.users.form.name') }}</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="name" value="{{ old('name', $viewData['user']->getName()) }}" type="text"
                  class="form-control">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.users.form.email') }}</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <input name="email" value="{{ old('email', $viewData['user']->getEmail()) }}" type="email"
                  class="form-control">
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
                <small class="form-text text-muted">{{ __('messages.admin.users.form.leave_blank') }}</small>
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
                <input name="balance" value="{{ old('balance', $viewData['user']->getBalance()) }}" type="number"
                  class="form-control">
              </div>
            </div>
          </div>
          <div class="col">
            <div class="mb-3 row">
              <label class="col-lg-2 col-md-6 col-sm-12 col-form-label">{{ __('messages.admin.users.form.role') }}</label>
              <div class="col-lg-10 col-md-6 col-sm-12">
                <select name="role" id="roleSelect" class="form-control">
                  <option value="client" {{ old('role', $viewData['user']->getRole()) == 'client' ? 'selected' : '' }}>{{ __('messages.admin.users.table.role') }}</option>
                  <option value="admin" {{ old('role', $viewData['user']->getRole()) == 'admin' ? 'selected' : '' }}>{{ __('messages.admin.users.table.super_admin') }}</option>
                </select>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col">
            <div class="mb-3 row">
              <div class="col-lg-10 col-md-6 col-sm-12">
                <div class="form-check form-switch">
                  <input type="checkbox" name="is_super_admin" value="1" id="isSuperAdminCheckbox"
                    {{ old('is_super_admin', $viewData['user']->getIsSuperAdmin()) ? 'checked' : '' }}
                    class="form-check-input" role="switch">
                  <label class="form-check-label" for="isSuperAdminCheckbox">{{ __('messages.admin.users.form.is_super_admin') }}</label>
                </div>
              </div>
            </div>
          </div>
        </div>
        <button type="submit" class="btn btn-primary">{{ __('messages.admin.users.form.update') }}</button>
        <a href="{{ route('admin.user.index') }}" class="btn btn-secondary">{{ __('messages.admin.users.form.cancel') }}</a>
      </form>
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
          superAdminCheckbox.checked = false; // Optionally uncheck if client is selected
        } else {
          superAdminCheckbox.disabled = false;
        }
      }

      // Initial check on page load
      toggleSuperAdminCheckbox();

      // Add event listener for role changes
      roleSelect.addEventListener('change', toggleSuperAdminCheckbox);
    });
  </script>
@endpush
