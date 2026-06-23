<?php

namespace App\Services;

use App\Models\Order;
use App\Models\User;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;

class ReportService
{


    private function applyDateFilter($query, ?string $from, ?string $to)
{
    if ($from) {
        $query->whereDate('created_at', '>=', $from);
    }

    if ($to) {
        $query->whereDate('created_at', '<=', $to);
    }

    return $query;
}

public function salesReport(?string $from = null, ?string $to = null)
{
    $baseQuery = Order::query();

    $this->applyDateFilter($baseQuery, $from, $to);

    return [
        'from' => $from,
        'to' => $to,

        'total_sales' => (clone $baseQuery)
            ->where('payment_status', 'paid')
            ->sum('grand_total'),

        'total_orders' => (clone $baseQuery)->count(),

        'paid_orders' => (clone $baseQuery)
            ->where('payment_status', 'paid')
            ->count(),

        'pending_orders' => (clone $baseQuery)
            ->where('payment_status', 'pending')
            ->count(),

        'cancelled_orders' => (clone $baseQuery)
            ->where('status', 'cancelled')
            ->count(),
    ];
}

    public function ordersReport()
    {
        return Order::select('status', DB::raw('COUNT(*) as total'))
            ->groupBy('status')
            ->get();
    }

    public function topProducts()
    {
        return OrderItem::select(
                'product_id',
                'product_name',
                DB::raw('SUM(quantity) as total_sold'),
                DB::raw('SUM(total) as total_revenue')
            )
            ->groupBy('product_id', 'product_name')
            ->orderByDesc('total_sold')
            ->limit(10)
            ->get();
    }

    public function customersReport()
    {
        return [
            'total_customers' => User::role('customer')->count(),
            'active_customers' => User::role('customer')->where('status', true)->count(),
        ];
    }

        public function monthlySales()
{
    return Order::selectRaw("
            DATE_FORMAT(created_at, '%Y-%m') as month,
            COUNT(*) as total_orders,
            SUM(grand_total) as total_sales
        ")
        ->groupBy('month')
        ->orderBy('month')
        ->get();
}

public function dashboardSummary()
{
    return [
        'total_orders' => Order::count(),

        'total_revenue' => Order::where(
            'payment_status',
            'paid'
        )->sum('grand_total'),

        'pending_orders' => Order::where(
            'status',
            'pending'
        )->count(),

        'delivered_orders' => Order::where(
            'status',
            'delivered'
        )->count(),

        'cancelled_orders' => Order::where(
            'status',
            'cancelled'
        )->count(),

        'total_customers' => User::role('customer')->count(),

        'recent_orders' => Order::with('user')
            ->latest()
            ->limit(5)
            ->get([
                'id',
                'user_id',
                'order_number',
                'grand_total',
                'status',
                'payment_status',
                'created_at',
            ]),

        'top_products' => OrderItem::select(
                'product_id',
                'product_name',
                DB::raw('SUM(quantity) as total_sold'),
                DB::raw('SUM(total) as total_revenue')
            )
            ->groupBy('product_id', 'product_name')
            ->orderByDesc('total_sold')
            ->limit(5)
            ->get(),
    ];
}


}