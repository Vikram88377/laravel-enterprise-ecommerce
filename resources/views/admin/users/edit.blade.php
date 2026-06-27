@extends('admin.layouts.app')

@section('title','Edit User')

@section('content')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Edit User</h3>

        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm float-right">
            Back
        </a>
    </div>

    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        @include('admin.users._form')
    </form>

</div>

@endsection