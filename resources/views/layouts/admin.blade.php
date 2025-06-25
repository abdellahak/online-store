<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
    crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link href="{{ asset('/css/admin.css') }}" rel="stylesheet" />
  <title>@yield('title', 'Admin - Online Store')</title>
  @stack('styles')
</head>

<body>
  <div class="row g-0">
    <!-- sidebar -->
    <div class="p-3 col fixed text-white bg-dark">
      <a href="{{ route('admin.home.index') }}" class="text-white text-decoration-none">
        <span class="fs-4">{{__('messages.layouts.admin.logo')}}</span>
      </a>
      <hr />
      <ul class="nav flex-column">
        <li><a href="{{ route('admin.home.index') }}" class="nav-link text-white">{{__('messages.layouts.app.home')}}</a></li>
        <li><a href="{{ route('admin.dashboard.index') }}" class="nav-link text-white">{{__('messages.layouts.admin.dashboard')}}</a></li>
        <li><a href="{{ route('admin.product.index') }}" class="nav-link text-white">{{__('messages.layouts.admin.products')}}</a></li>
        <li><a href="{{ route('admin.category.index') }}" class="nav-link text-white">{{__('messages.layouts.admin.categories')}}</a></li>
        <li><a href="{{ route('admin.supplier.index') }}" class="nav-link text-white">{{__('messages.layouts.admin.suppliers')}}</a></li>
        <li><a href="{{ route('admin.soldes.index') }}" class="nav-link text-white">{{__('messages.layouts.admin.soldes')}}</a></li>

        <li><a href="{{ route('admin.order.index') }}" class="nav-link text-white">{{__('messages.layouts.admin.orders')}}</a></li>
        @if (Auth::user() && Auth::user()->is_super_admin)
          <li><a href="{{ route('admin.user.index') }}" class="nav-link text-white">{{__('messages.layouts.admin.users')}}</a></li>
        @endif
        <li>
          <a href="{{ route('home.index') }}" class="mt-2 btn bg-primary text-white">{{__('messages.layouts.admin.rutern_home')}}</a>
        </li>
      </ul>
    </div>
    <!-- sidebar -->
    <div class="col content-grey">
      <nav class="p-3 shadow text-end">
        <span class="profile-font">Admin</span>
        <img class="img-profile rounded-circle" src="{{ asset('/img/undraw_profile.svg') }}">
        <form action="{{ route('locale.switch') }}" method="POST" class="d-inline ms-2">
          @csrf
          <select name="locale" onchange="this.form.submit()" class="form-select form-select-sm" style="width:auto;display:inline-block;">
            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
            <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>Français</option>
            <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
          </select>
        </form>
      </nav>

      <div class="g-0 m-5">
        @yield('content')
      </div>
    </div>
  </div>

  <!-- footer -->
  <div class="copyright py-4 text-center text-white">
    <div class="container">
      <small>
        Copyright - <a class="text-reset fw-bold text-decoration-none" target="_blank"
          href="https://twitter.com/danielgarax">
          Daniel Correa
        </a> - <b>Paola Vallejo</b>
      </small>
    </div>
  </div>
  <!-- footer -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    crossorigin="anonymous"></script>
  @stack('scripts')
</body>

</html>
