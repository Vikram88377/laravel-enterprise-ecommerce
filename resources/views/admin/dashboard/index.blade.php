@extends('admin.layouts.app')

@section('title', 'Dashboard')

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
                <h3>{{ $totalProducts }}</h3>
                <p>Total Products</p>
            </div>
            <div class="icon">
                <i class="fas fa-box"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>{{ $totalUsers }}</h3>
                <p>Total Users</p>
            </div>
            <div class="icon">
                <i class="fas fa-users"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="small-box bg-danger">
            <div class="inner">
                <h3>₹{{ $totalRevenue }}</h3>
                <p>Total Revenue</p>
            </div>
            <div class="icon">
                <i class="fas fa-rupee-sign"></i>
            </div>
        </div>
    </div>


            <div class="card">

    <div class="card-header">

        <h3 class="card-title">

            Recent Orders

        </h3>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered">

            <thead>

            <tr>

                <th>ID</th>

                <th>Customer</th>

                <th>Order Number</th>

                <th>Total</th>

                <th>Status</th>

            </tr>

            </thead>

            <tbody>

            @foreach($recentOrders as $order)

                <tr>

                    <td>{{ $order->id }}</td>

                    <td>{{ $order->user->name }}</td>

                    <td>{{ $order->order_number }}</td>

                    <td>₹{{ number_format($order->grand_total,2) }}</td>

                    <td>

                        <span class="badge badge-info">

                            {{ ucfirst($order->status) }}

                        </span>

                    </td>

                </tr>

            @endforeach

            </tbody>

        </table>

    </div>

</div>


</div>

@endsection