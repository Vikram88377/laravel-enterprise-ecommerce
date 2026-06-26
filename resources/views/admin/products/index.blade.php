@extends('admin.layouts.app')

@section('title','Products')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<div class="card">

    <div class="card-header">

        <h3 class="card-title">
            Product List
        </h3>

        <a href="{{ route('admin.products.create') }}"
           class="btn btn-primary float-right">

            Add Product

        </a>

    </div>

    <div class="card-body table-responsive">

        <table class="table table-bordered table-hover datatable">

            <thead>

            <tr>

                <th>ID</th>

                <th>Category</th>

                <th>Name</th>

                <th>SKU</th>

                <th>Price</th>

                <th>Stock</th>

                <th>Status</th>

                <th width="180">
                    Action
                </th>

            </tr>

            </thead>

            <tbody>

            @forelse($products as $product)

            <tr>

                <td>{{ $product->id }}</td>

                <td>{{ $product->category->name ?? '-' }}</td>

                <td>{{ $product->name }}</td>

                <td>{{ $product->sku }}</td>

                <td>₹{{ number_format($product->price,2) }}</td>

                <td>{{ $product->stock }}</td>

                <td>

                    @if($product->status)

                        <span class="badge badge-success">

                            Active

                        </span>

                    @else

                        <span class="badge badge-danger">

                            Inactive

                        </span>

                    @endif

                </td>

                <td>

                    <a href="{{ route('admin.products.edit',$product) }}"
                       class="btn btn-warning btn-sm">

                        Edit

                    </a>

                    <form
                        action="{{ route('admin.products.destroy',$product) }}"
                        method="POST"
                        class="d-inline">

                        @csrf
                        @method('DELETE')

                        <button
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete Product?')">

                            Delete

                        </button>

                    </form>

                </td>

            </tr>

            @empty

            <tr>

                <td colspan="8">

                    No Products Found

                </td>

            </tr>

            @endforelse

            </tbody>

        </table>

        {{-- {{ $products->links() }} --}}

    </div>

</div>

@endsection