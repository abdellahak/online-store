<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous" />
  <link href="{{ asset('/css/app.css') }}" rel="stylesheet" />
  <title>@yield('title', 'Online Store')</title>
</head>
<body>
  <!-- header -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary py-4">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home.index') }}">Online Store</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav ms-auto align-items-center d-flex">
          <a class="nav-link active" href="{{ route('home.index') }}">{{ __('messages.layouts.app.home') }}</a>
          <a class="nav-link active" href="{{ route('product.index') }}">{{ __('messages.layouts.app.products') }}</a>
          <a class="nav-link active" href="{{ route('cart.index') }}">{{ __('messages.layouts.app.cart') }}</a>
          <a class="nav-link active" href="{{ route('home.about') }}">{{ __('messages.layouts.app.about') }}</a>
          <div class="vr bg-white mx-2 d-none d-lg-block"></div>
          @guest
          <a class="nav-link active" href="{{ route('login') }}">{{ __('messages.layouts.app.login') }}</a>
          <a class="nav-link active" href="{{ route('register') }}">{{ __('messages.layouts.app.register') }}</a>
          @else
          <a class="nav-link active" href="{{ route('myaccount.orders') }}">{{ __('messages.layouts.app.my_orders') }}</a>
          <form id="logout" action="{{ route('logout') }}" method="POST" class="d-inline">
        <a role="button" class="nav-link active"
           onclick="document.getElementById('logout').submit();">{{ __('messages.layouts.shared.Logout') }}</a>
        @csrf
          </form>
          @endguest
          <form action="{{ route('locale.switch') }}" method="POST" class="d-inline ms-2">
        @csrf
        <select name="locale" onchange="this.form.submit()" class="form-select form-select-sm" style="width:auto;display:inline-block;">
            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
            <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>Français</option>
            <option value="ar" {{ app()->getLocale() == 'ar' ? 'selected' : '' }}>العربية</option>
        </select>
          </form>
        </div>
      </div>
    </div>
  </nav>

  <header class="masthead bg-primary text-white text-center py-4">
    <div class="container d-flex align-items-center flex-column">
      <h2>@yield('subtitle', __('messages.home.index.title'))</h2>
    </div>
  </header>
  <!-- header -->

  <div class="container my-4">
    @yield('content')
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
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
</body>
</html>
