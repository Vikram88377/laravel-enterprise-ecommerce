<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.reports.index', [
            'totalOrders' => Order::count(),

            'totalRevenue' => Order::where('payment_status', 'paid')
                ->sum('grand_total'),

            'pendingOrders' => Order::where('status', 'pending')->count(),

            'cancelledOrders' => Order::where('status', 'cancelled')->count(),

            'totalCustomers' => User::role('customer')->count(),

            'totalProducts' => Product::count(),

            'topProducts' => OrderItem::select(
                    'product_id',
                    'product_name',
                    DB::raw('SUM(quantity) as total_sold'),
                    DB::raw('SUM(total) as total_revenue')
                )
                ->groupBy('product_id', 'product_name')
                ->orderByDesc('total_sold')
                ->limit(10)
                ->get(),

            'monthlySales' => Order::selectRaw("
                    DATE_FORMAT(created_at, '%Y-%m') as month,
                    COUNT(*) as total_orders,
                    SUM(grand_total) as total_sales
                ")
                ->groupBy('month')
                ->orderBy('month')
                ->get(),
        ]);
    }
}