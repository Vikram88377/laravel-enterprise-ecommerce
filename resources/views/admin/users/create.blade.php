@extends('admin.layouts.app')

@section('title','Create User')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Create User</h3>

        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm float-right">
            Back
        </a>
    </div>

    <form action="{{ route('admin.users.store') }}" method="POST">
        @csrf

        @include('admin.users._form')
    </form>

</div>

@endsection