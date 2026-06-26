@extends('admin.layouts.app')

@section('title','Edit Coupon')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Edit Coupon</h3>

        <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary btn-sm float-right">
            Back
        </a>
    </div>

    <form action="{{ route('admin.coupons.update', $coupon) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.coupons._form')
    </form>

</div>

@endsection