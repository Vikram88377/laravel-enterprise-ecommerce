@extends('admin.layouts.app')

@section('title','Order Details')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">

    <div class="card-header">
        <h3 class="card-title">
            Order: {{ $order->order_number }}
        </h3>

        <a href="{{ route('admin.orders.index') }}"
           class="btn btn-secondary btn-sm float-right">
            Back
        </a>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-6">
                <h5>Customer Details</h5>

                <p><strong>Name:</strong> {{ $order->user->name ?? '-' }}</p>
                <p><strong>Email:</strong> {{ $order->user->email ?? '-' }}</p>
                <p><strong>Phone:</strong> {{ $order->user->phone ?? '-' }}</p>
            </div>

            <div class="col-md-6">
                <h5>Order Details</h5>

                <p><strong>Order Number:</strong> {{ $order->order_number }}</p>
                <p><strong>Status:</strong> {{ ucfirst($order->status) }}</p>
                <p><strong>Payment Status:</strong> {{ ucfirst($order->payment_status) }}</p>
                <p><strong>Payment Method:</strong> {{ ucfirst($order->payment_method ?? '-') }}</p>
            </div>

        </div>

        <hr>

        <h5>Update Order Status</h5>

        <form action="{{ route('admin.orders.update-status', $order) }}"
              method="POST"
              class="form-inline mb-4">

            @csrf
            @method('PATCH')

            <select name="status" class="form-control mr-2">
                @foreach(['pending','confirmed','processing','shipped','delivered','cancelled'] as $status)
                    <option value="{{ $status }}" @selected($order->status === $status)>
                        {{ ucfirst($status) }}
                    </option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-primary">
                Update Status
            </button>

        </form>

        <h5>Order Items</h5>

        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>Product</th>
                    <th>SKU</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($order->items as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->sku }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>₹{{ number_format($item->price, 2) }}</td>
                        <td>₹{{ number_format($item->total, 2) }}</td>
                    </tr>
                @endforeach
            </tbody>

        </table>

        <hr>

        <div class="row">

            <div class="col-md-6 offset-md-6">

                <table class="table table-bordered">

                    <tr>
                        <th>Subtotal</th>
                        <td>₹{{ number_format($order->subtotal, 2) }}</td>
                    </tr>

                    <tr>
                        <th>Discount</th>
                        <td>₹{{ number_format($order->discount, 2) }}</td>
                    </tr>

                    <tr>
                        <th>Tax</th>
                        <td>₹{{ number_format($order->tax, 2) }}</td>
                    </tr>

                    <tr>
                        <th>Shipping</th>
                        <td>₹{{ number_format($order->shipping_charge, 2) }}</td>
                    </tr>

                    <tr>
                        <th>Grand Total</th>
                        <td>
                            <strong>
                                ₹{{ number_format($order->grand_total, 2) }}
                            </strong>
                        </td>
                    </tr>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection