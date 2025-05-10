<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Solde;

class AdminDashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        $start = $request->input('start_date', Carbon::now()->subMonth()->toDateString());
        $end = $request->input('end_date', Carbon::now()->toDateString());

        if (strtotime($start) > strtotime($end)) {
            return redirect()->back()->with('error', 'Invalid date range selected.');
        }

        $revenueByDay = DB::table('orders')
            ->join('items', 'orders.id', '=', 'items.order_id')
            ->selectRaw('DATE(orders.created_at) as date, SUM(items.price * items.quantity) as revenue, SUM(items.quantity) as products_sold')
            ->whereDate('orders.created_at', '>=', $start)
            ->whereDate('orders.created_at', '<=', $end)
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        $revenueByMonth = DB::table('orders')
            ->join('items', 'orders.id', '=', 'items.order_id')
            ->selectRaw('DATE_FORMAT(orders.created_at, "%Y-%m") as month, SUM(items.price * items.quantity) as revenue, SUM(items.quantity) as products_sold')
            ->whereDate('orders.created_at', '>=', $start)
            ->whereDate('orders.created_at', '<=', $end)
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();

        $revenueByYear = DB::table('orders')
            ->join('items', 'orders.id', '=', 'items.order_id')
            ->selectRaw('YEAR(orders.created_at) as year, SUM(items.price * items.quantity) as revenue, SUM(items.quantity) as products_sold')
            ->whereDate('orders.created_at', '>=', $start)
            ->whereDate('orders.created_at', '<=', $end)
            ->groupBy('year')
            ->orderBy('year', 'asc')
            ->get();

        $revenueByProduct = DB::table('orders')
            ->join('items', 'orders.id', '=', 'items.order_id')
            ->join('products', 'items.product_id', '=', 'products.id')
            ->selectRaw('products.name, SUM(items.price * items.quantity) as revenue, SUM(items.quantity) as products_sold')
            ->whereDate('orders.created_at', '>=', $start)
            ->whereDate('orders.created_at', '<=', $end)
            ->groupBy('products.name')
            ->orderBy('revenue', 'desc')
            ->limit(10)
            ->get();

        $revenueByCategory = DB::table('orders')
            ->join('items', 'orders.id', '=', 'items.order_id')
            ->join('products', 'items.product_id', '=', 'products.id')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->selectRaw('categories.name, SUM(items.price * items.quantity) as revenue, SUM(items.quantity) as products_sold')
            ->whereDate('orders.created_at', '>=', $start)
            ->whereDate('orders.created_at', '<=', $end)
            ->groupBy('categories.name')
            ->orderBy('revenue', 'desc')
            ->get();

        $revenueByPeriod = Order::whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->sum('total');
        $orderCount = Order::whereDate('created_at', '>=', $start)
            ->whereDate('created_at', '<=', $end)
            ->count();
        $productsSold = DB::table('orders')
            ->join('items', 'orders.id', '=', 'items.order_id')
            ->whereDate('orders.created_at', '>=', $start)
            ->whereDate('orders.created_at', '<=', $end)
            ->sum('items.quantity');
        $avgOrderAmount = $orderCount ? $revenueByPeriod / $orderCount : 0;

        $customerCount = User::where('role', 'client')->count();
        $productCount = Product::count();
        $categoryCount = Category::count();
        $discountCount = Solde::count();

        return view('admin.dashboard.index', compact(
            'revenueByDay',
            'revenueByMonth',
            'revenueByYear',
            'revenueByProduct',
            'revenueByCategory',
            'revenueByPeriod',
            'orderCount',
            'productsSold',
            'avgOrderAmount',
            'start',
            'end',
            'customerCount',
            'productCount',
            'categoryCount',
            'discountCount'
        ));
    }
}
