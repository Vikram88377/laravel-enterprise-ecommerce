@extends('admin.layouts.app')

@section('title','Create Product')

@section('content')

<div class="card">

    <div class="card-header">

        <h3>Create Product</h3>

    </div>

  <form
    action="{{ route('admin.products.store') }}"
    method="POST"
    enctype="multipart/form-data">

        @csrf

        @include('admin.products._form')

    </form>

</div>

@endsection