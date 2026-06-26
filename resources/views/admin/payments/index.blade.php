@extends('admin.layouts.app')

@section('title','Payments')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Payment List</h3>
    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover datatable">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Order</th>
                    <th>User</th>
                    <th>Gateway</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Gateway Payment ID</th>
                    <th>Date</th>
                </tr>
            </thead>

            <tbody>
                @forelse($payments as $payment)
                    <tr>
                        <td>{{ $payment->id }}</td>

                        <td>
                            {{ $payment->order->order_number ?? '-' }}
                        </td>

                        <td>
                            {{ $payment->user->name ?? '-' }}
                        </td>

                        <td>
                            <span class="badge badge-info">
                                {{ ucfirst($payment->gateway) }}
                            </span>
                        </td>

                        <td>
                            ₹{{ number_format($payment->amount, 2) }}
                        </td>

                        <td>
                            @if($payment->status === 'paid')
                                <span class="badge badge-success">Paid</span>
                            @elseif($payment->status === 'failed')
                                <span class="badge badge-danger">Failed</span>
                            @elseif($payment->status === 'refunded')
                                <span class="badge badge-warning">Refunded</span>
                            @else
                                <span class="badge badge-secondary">Pending</span>
                            @endif
                        </td>

                        <td>
                            {{ $payment->gateway_payment_id ?? '-' }}
                        </td>

                        <td>
                            {{ $payment->created_at->format('d M Y') }}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8">No payments found</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        {{ $payments->links() }}

    </div>

</div>

@endsection