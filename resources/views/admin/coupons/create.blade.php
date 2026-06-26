@extends('admin.layouts.app')

@section('title','Create Coupon')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Create Coupon</h3>

        <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary btn-sm float-right">
            Back
        </a>
    </div>

    <form action="{{ route('admin.coupons.store') }}" method="POST">
        @csrf

        @include('admin.coupons._form')
    </form>

</div>

@endsection