@extends('admin.layouts.app')

@section('title','Reports')

@section('content')

<div class="row">

    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>{{ $totalOrders }}</h3>
                <p>Total Orders</p>
            </div>
            <div class="icon">
                <i class="fas fa-shopping-cart"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>₹{{ number_format($totalRevenue, 2) }}</h3>
                <p>Total Revenue</p>
            </div>
            <div class="icon">
                <i class="fas fa-rupee-sign"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalCustomers }}</h3>
                <p>Total Customers</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>{{ $cancelledOrders }}</h3>
                <p>Cancelled Orders</p>
            </div>
            <div class="icon">
                <i class="fas fa-ban"></i>
            </div>
        </div>
    </div>

</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Top Selling Products</h3>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Total Sold</th>
                    <th>Total Revenue</th>
                </tr>
            </thead>

            <tbody>
                @forelse($topProducts as $product)
                    <tr>
                        <td>{{ $product->product_name }}</td>
                        <td>{{ $product->total_sold }}</td>
                        <td>₹{{ number_format($product->total_revenue, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No data found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Monthly Sales</h3>
    </div>

    <div class="card-body table-responsive">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Total Orders</th>
                    <th>Total Sales</th>
                </tr>
            </thead>

            <tbody>
                @forelse($monthlySales as $sale)
                    <tr>
                        <td>{{ $sale->month }}</td>
                        <td>{{ $sale->total_orders }}</td>
                        <td>₹{{ number_format($sale->total_sales, 2) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">No sales found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection