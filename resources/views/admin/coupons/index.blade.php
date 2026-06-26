@extends('admin.layouts.app')

@section('title','Coupons')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Coupon List</h3>

        <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary btn-sm float-right">
            Add Coupon
        </a>
    </div>

    <div class="card-body table-responsive">

       <table class="table table-bordered table-hover datatable">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Code</th>
                    <th>Type</th>
                    <th>Value</th>
                    <th>Min Order</th>
                    <th>Max Discount</th>
                    <th>Used</th>
                    <th>Status</th>
                    <th width="180">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($coupons as $coupon)
                    <tr>
                        <td>{{ $coupon->id }}</td>
                        <td>{{ $coupon->code }}</td>
                        <td>{{ ucfirst($coupon->type) }}</td>
                        <td>
                            @if($coupon->type === 'percentage')
                                {{ $coupon->value }}%
                            @else
                                ₹{{ number_format($coupon->value, 2) }}
                            @endif
                        </td>
                        <td>₹{{ number_format($coupon->min_order_amount, 2) }}</td>
                        <td>
                            {{ $coupon->max_discount ? '₹'.number_format($coupon->max_discount, 2) : '-' }}
                        </td>
                        <td>{{ $coupon->used_count }}/{{ $coupon->usage_limit ?? '∞' }}</td>
                        <td>
                            @if($coupon->status)
                                <span class="badge badge-success">Active</span>
                            @else
                                <span class="badge badge-danger">Inactive</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.coupons.edit', $coupon) }}"
                               class="btn btn-warning btn-sm">
                                Edit
                            </a>

                            <form action="{{ route('admin.coupons.destroy', $coupon) }}"
                                  method="POST"
                                  class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Delete coupon?')">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9">No coupons found</td>
                    </tr>
                @endforelse
            </tbody>

        </table>

        {{ $coupons->links() }}

    </div>

</div>

@endsection