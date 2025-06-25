@extends('layouts.admin')
@section('title', __('messages.admin.home.index.title'))
@section('content')
  <div class="container-fluid">
    @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="d-flex justify-content-between align-items-center">
      <h2 class="mb-4 fw-bold text-primary">{{ __('messages.admin.home.index.welcome.title') }}</h2>
      <a href="{{ route('admin.dashboard.index') }}" class="btn btn-secondary"><i class="bi bi-arrow-clockwise"></i>
        {{ __('messages.dashboard.reset') }}</a>
    </div>

    {{-- Quick Links --}}
    <div class="card mb-4">
      <div class="card-header">
        <div class="d-flex justify-content-between align-items-center">
          <h5 class="mb-0">{{ __('messages.dashboard.quick_links') }}</h5>
        </div>
        <p class="text-muted mb-0">{{ __('messages.dashboard.overview_desc') }}</p>
      </div>
      <div class="card-body">
        <div class="row g-4 mb-5">
          <div class="col-12 col-md-3">
            <a href="{{ route('admin.user.index') }}" class="dashboard-link-card">
              <div class="card custom-link-card bg-dark shadow h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="card-title mb-2">{{ __('messages.admin.users.manage_title') }}</h6>
                    <div class="link-value count-up" data-target="{{ $customerCount }}">{{ $customerCount }}</div>
                  </div>
                  <i class="bi bi-people-fill link-icon"></i>
                </div>
              </div>
            </a>
          </div>
          <div class="col-12 col-md-3">
            <a href="{{ route('admin.product.index') }}" class="dashboard-link-card">
              <div class="card custom-link-card bg-secondary shadow h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="card-title mb-2">{{ __('messages.admin.product.index.manage_title') }}</h6>
                    <div class="link-value count-up" data-target="{{ $productCount }}">{{ $productCount }}</div>
                  </div>
                  <i class="bi bi-boxes link-icon"></i>
                </div>
              </div>
            </a>
          </div>
          <div class="col-12 col-md-3">
            <a href="{{ route('admin.category.index') }}" class="dashboard-link-card">
              <div class="card custom-link-card bg-primary shadow h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="card-title mb-2">{{ __('messages.admin.categories.index.title') }}</h6>
                    <div class="link-value count-up" data-target="{{ $categoryCount }}">{{ $categoryCount }}</div>
                  </div>
                  <i class="bi bi-tags-fill link-icon"></i>
                </div>
              </div>
            </a>
          </div>
          <div class="col-12 col-md-3">
            <a href="{{ route('admin.soldes.index') }}" class="dashboard-link-card">
              <div class="card custom-link-card bg-success shadow h-100">
                <div class="card-body d-flex align-items-center justify-content-between">
                  <div>
                    <h6 class="card-title mb-2">{{ __('messages.admin.soldes.index.manage_title') }}</h6>
                    <div class="link-value count-up" data-target="{{ $discountCount }}">{{ $discountCount }}</div>
                  </div>
                  <i class="bi bi-percent link-icon"></i>
                </div>
              </div>
            </a>
          </div>
        </div>
      </div>
    </div>

    {{-- Exportable Dashboard Content --}}
    <div id="dashboard-export-content">
      <div class="card mb-4">
        <div class="card-header">
          <div class="d-flex justify-content-between align-items-center">
            <h5 class="mb-0">{{ __('messages.dashboard.overview') }}</h5>
          </div>
          <p class="text-muted mb-0">{{ __('messages.dashboard.overview_desc') }}</p>
        </div>
        <div class="card-body">
          {{-- Period Filter Form --}}
          <form method="GET" class="row g-3 align-items-end mb-4 d-print-none" id="dashboard-period-form">
            <div class="col-md-3">
              <label for="start_date" class="form-label fw-semibold">{{ __('messages.dashboard.start_date') }}</label>
              <input type="date" id="start_date" name="start_date" class="form-control" value="{{ $start }}">
            </div>
            <div class="col-md-3">
              <label for="end_date" class="form-label fw-semibold">{{ __('messages.dashboard.end_date') }}</label>
              <input type="date" id="end_date" name="end_date" class="form-control" value="{{ $end }}">
            </div>
            <div class="col-md-6 d-flex align-items-end">
              <button type="submit" class="btn btn-lg btn-primary me-2"><i class="bi bi-search"></i> {{ __('messages.dashboard.filter') }}</button>
              @if (request('start_date') || request('end_date'))
                <a href="{{ route('admin.dashboard.index') }}" class="btn btn-lg btn-secondary me-2"><i
                    class="bi bi-arrow-counterclockwise"></i> {{ __('messages.dashboard.reset') }}</a>
              @endif
              <button type="button" id="downloadPdfBtn" class="btn btn-lg btn-danger"><i
                  class="bi bi-file-earmark-pdf"></i> {{ __('messages.dashboard.download_pdf') }}</button>
            </div>
          </form>
          {{-- Everything below will be included in the PDF --}}
          <div id="dashboard-main-content">
            {{-- KPIs Row --}}
            <div class="row g-4 mb-4">
              <div class="col-12 col-md-3">
                <div class="card kpi-card text-white bg-primary shadow h-100">
                  <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                      <h6 class="card-title mb-2">{{ __('messages.dashboard.period_revenue') }}</h6>
                      <div class="kpi-value count-up" data-target="{{ $revenueByPeriod }}">
                        ${{ number_format($revenueByPeriod, 2) }}</div>
                    </div>
                    <i class="bi bi-cash-coin kpi-icon"></i>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-3">
                <div class="card kpi-card text-white bg-success shadow h-100">
                  <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                      <h6 class="card-title mb-2">{{ __('messages.dashboard.orders') }}</h6>
                      <div class="kpi-value count-up" data-target="{{ $orderCount }}">{{ $orderCount }}</div>
                    </div>
                    <i class="bi bi-receipt kpi-icon"></i>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-3">
                <div class="card kpi-card text-white bg-info shadow h-100">
                  <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                      <h6 class="card-title mb-2">{{ __('messages.dashboard.products_sold') }}</h6>
                      <div class="kpi-value count-up" data-target="{{ $productsSold }}">{{ $productsSold }}</div>
                    </div>
                    <i class="bi bi-box-seam kpi-icon"></i>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-3">
                <div class="card kpi-card text-white bg-warning shadow h-100">
                  <div class="card-body d-flex align-items-center justify-content-between">
                    <div>
                      <h6 class="card-title mb-2">{{ __('messages.dashboard.avg_order_amount') }}</h6>
                      <div class="kpi-value count-up" data-target="{{ $avgOrderAmount }}">
                        ${{ number_format($avgOrderAmount, 2) }}</div>
                    </div>
                    <i class="bi bi-graph-up-arrow kpi-icon"></i>
                  </div>
                </div>
              </div>
            </div>

            {{-- Charts Row --}}
            <div class="row g-4 mb-4">
              <div class="col-lg-6">
                <div class="card shadow h-100">
                  <div class="card-header bg-success text-white fw-semibold">{{ __('messages.dashboard.revenue_by_month_chart') }}</div>
                  <div class="card-body">
                    <canvas id="revenueByMonthChart" height="120"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card shadow h-100">
                  <div class="card-header bg-primary text-white fw-semibold">{{ __('messages.dashboard.revenue_by_day_chart') }}</div>
                  <div class="card-body">
                    <canvas id="revenueByDayChart" height="120"></canvas>
                  </div>
                </div>
              </div>
            </div>
            <div class="row g-4 mb-4">
              <div class="col-lg-6">
                <div class="card shadow h-100">
                  <div class="card-header bg-info text-white fw-semibold">{{ __('messages.dashboard.top_products_chart') }}</div>
                  <div class="card-body">
                    <canvas id="topProductsChart" height="200"></canvas>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="card shadow h-100">
                  <div class="card-header bg-warning text-white fw-semibold">{{ __('messages.dashboard.revenue_by_category_chart') }}</div>
                  <div class="card-body">
                    <canvas id="revenueByCategoryChart" height="120"></canvas>
                  </div>
                </div>
              </div>
            </div>

            {{-- Tables Row --}}
            <div class="row g-4 tableDataContainer">
              <div class="col-lg-6 tableData">
                <div class="card shadow h-100">
                  <div class="card-header bg-primary text-white fw-semibold">{{ __('messages.dashboard.revenue_by_day') }}</div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-sm table-striped mb-0 align-middle">
                        <thead class="table-light">
                          <tr>
                            <th>{{ __('messages.dashboard.date') }}</th>
                            <th>{{ __('messages.dashboard.revenue') }}</th>
                            <th>{{ __('messages.dashboard.products_sold_col') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($revenueByDay as $row)
                            <tr>
                              <td>{{ $row->date }}</td>
                              <td class="fw-semibold">${{ number_format($row->revenue, 2) }}</td>
                              <td class="fw-semibold">{{ $row->products_sold }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 tableData">
                <div class="card shadow h-100">
                  <div class="card-header bg-success text-white fw-semibold">{{ __('messages.dashboard.revenue_by_month') }}</div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-sm table-striped mb-0 align-middle">
                        <thead class="table-light">
                          <tr>
                            <th>{{ __('messages.dashboard.month') }}</th>
                            <th>{{ __('messages.dashboard.revenue') }}</th>
                            <th>{{ __('messages.dashboard.products_sold_col') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($revenueByMonth as $row)
                            <tr>
                              <td>{{ $row->month }}</td>
                              <td class="fw-semibold">${{ number_format($row->revenue, 2) }}</td>
                              <td class="fw-semibold">{{ $row->products_sold }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 tableData">
                <div class="card shadow h-100">
                  <div class="card-header bg-info text-white fw-semibold">{{ __('messages.dashboard.top_products') }}</div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-sm table-striped mb-0 align-middle">
                        <thead class="table-light">
                          <tr>
                            <th>{{ __('messages.dashboard.product') }}</th>
                            <th>{{ __('messages.dashboard.revenue') }}</th>
                            <th>{{ __('messages.dashboard.products_sold_col') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($revenueByProduct as $row)
                            <tr>
                              <td>{{ $row->name }}</td>
                              <td class="fw-semibold">${{ number_format($row->revenue, 2) }}</td>
                              <td class="fw-semibold">{{ $row->products_sold }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6 tableData">
                <div class="card shadow h-100">
                  <div class="card-header bg-warning text-white fw-semibold">{{ __('messages.dashboard.revenue_by_category') }}</div>
                  <div class="card-body p-0">
                    <div class="table-responsive">
                      <table class="table table-sm table-striped mb-0 align-middle">
                        <thead class="table-light">
                          <tr>
                            <th>{{ __('messages.dashboard.category') }}</th>
                            <th>{{ __('messages.dashboard.revenue') }}</th>
                            <th>{{ __('messages.dashboard.products_sold_col') }}</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($revenueByCategory as $row)
                            <tr>
                              <td>{{ $row->name }}</td>
                              <td class="fw-semibold">${{ number_format($row->revenue, 2) }}</td>
                              <td class="fw-semibold">{{ $row->products_sold }}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-12 tableData">
                <div class="card shadow h-100">
                  <div class="card-header bg-secondary text-white fw-semibold">{{ __('messages.dashboard.revenue_by_year') }}</div>
                  <div class="table-responsive">
                    <table class="table table-sm table-striped mb-0 align-middle">
                      <thead class="table-light">
                        <tr>
                          <th>{{ __('messages.dashboard.year') }}</th>
                          <th>{{ __('messages.dashboard.revenue') }}</th>
                          <th>{{ __('messages.dashboard.products_sold_col') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($revenueByYear as $row)
                          <tr>
                            <td>{{ $row->year }}</td>
                            <td class="fw-semibold">${{ number_format($row->revenue, 2) }}</td>
                            <td class="fw-semibold">{{ $row->products_sold }}</td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('styles')
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <style>
    .kpi-card {
      border-radius: 1.2rem;
      min-height: 120px;
      transition: box-shadow 0.2s, transform 0.2s;
    }

    .kpi-card:hover {
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
      transform: translateY(-2px) scale(1.03);
    }

    .kpi-value {
      font-size: 2.2rem;
      font-weight: 700;
      letter-spacing: 1px;
      margin-bottom: 0;
    }

    .kpi-icon {
      font-size: 3.2rem;
      opacity: 0.85;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.12));
    }

    .link-value {
      font-size: 1.7rem;
      font-weight: 600;
      color: #fff;
    }

    .link-icon {
      font-size: 2.5rem;
      opacity: 0.9;
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.12));
    }

    .dashboard-link-card {
      text-decoration: none;
      display: block;
      height: 100%;
    }

    .custom-link-card {
      border: 2px solid #fff;
      transition: transform 0.2s cubic-bezier(.4, 2, .6, 1), box-shadow 0.2s;
      box-shadow: 0 2px 16px rgba(0, 0, 0, 0.08);
      border-radius: 1.2rem;
      background: linear-gradient(135deg, #232526 0%, #414345 100%);
      position: relative;
      overflow: hidden;
      min-height: 100px;
    }

    .custom-link-card:hover,
    .dashboard-link-card:focus .custom-link-card {
      transform: scale(1.06);
      z-index: 2;
      box-shadow: 0 8px 32px rgba(0, 0, 0, 0.18);
      border-color: #ffc107;
    }

    .custom-link-card .card-title,
    .custom-link-card .link-value {
      color: #fff !important;
    }

    .custom-link-card .bi {
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.15));
    }

    .card-title {
      font-size: 1.08rem;
      font-weight: 500;
      letter-spacing: 0.5px;
    }

    .table th,
    .table td {
      vertical-align: middle !important;
    }

    .table thead th {
      font-size: 1rem;
      font-weight: 600;
      background: #f8f9fa;
    }

    .table td,
    .table th {
      padding: 0.55rem 0.75rem;
    }

    @media (max-width: 991.98px) {
      .kpi-value {
        font-size: 1.5rem;
      }

      .kpi-icon {
        font-size: 2.2rem;
      }

      .link-value {
        font-size: 1.2rem;
      }

      .link-icon {
        font-size: 1.6rem;
      }
    }

    @media (max-width: 767.98px) {

      .kpi-card,
      .custom-link-card {
        min-height: 80px;
      }

      .kpi-value,
      .link-value {
        font-size: 1.1rem;
      }

      .kpi-icon,
      .link-icon {
        font-size: 1.2rem;
      }
    }
  </style>
@endpush

@push('scripts')
  <!-- Chart.js CDN -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script>
    window.dashboardData = {
      revenueByMonthLabels: {!! json_encode(collect($revenueByMonth)->pluck('month')) !!},
      revenueByMonthData: {!! json_encode(collect($revenueByMonth)->pluck('revenue')) !!},
      revenueByDayLabels: {!! json_encode(collect($revenueByDay)->pluck('date')) !!},
      revenueByDayData: {!! json_encode(collect($revenueByDay)->pluck('revenue')) !!},
      topProductsLabels: {!! json_encode(collect($revenueByProduct)->pluck('name')) !!},
      topProductsData: {!! json_encode(collect($revenueByProduct)->pluck('revenue')) !!},
      revenueByCategoryLabels: {!! json_encode(collect($revenueByCategory)->pluck('name')) !!},
      revenueByCategoryData: {!! json_encode(collect($revenueByCategory)->pluck('revenue')) !!}
    };
  </script>
  <script src="{{ asset('js/admin-dashboard.js') }}"></script>
@endpush
