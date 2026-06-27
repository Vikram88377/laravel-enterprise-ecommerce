@extends('admin.layouts.app')

@section('title','User Details')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">User Details</h3>

        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm float-right">
            Back
        </a>
    </div>

    <div class="card-body">

        <p><strong>Name:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Phone:</strong> {{ $user->phone ?? '-' }}</p>

        <p>
            <strong>Roles:</strong>
            @foreach($user->roles as $role)
                <span class="badge badge-info">{{ $role->name }}</span>
            @endforeach
        </p>

        <p>
            <strong>Status:</strong>
            @if($user->status)
                <span class="badge badge-success">Active</span>
            @else
                <span class="badge badge-danger">Inactive</span>
            @endif
        </p>

        <hr>

        <h5>User Orders</h5>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Order No</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment</th>
                </tr>
            </thead>

            <tbody>
                @forelse($user->orders as $order)
                    <tr>
                        <td>{{ $order->order_number }}</td>
                        <td>₹{{ number_format($order->grand_total, 2) }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ ucfirst($order->payment_status) }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No orders found</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
</div>

@endsection