@extends('admin.layouts.app')

@section('title','Edit Product')

@section('content')

<div class="card">

    <div class="card-header">

        <h3>Edit Product</h3>

    </div>

        <form
            action="{{ route('admin.products.update',$product) }}"
            method="POST"
            enctype="multipart/form-data">

        @csrf
        @method('PUT')

        @include('admin.products._form')

    </form>
        @if($product->images->count() > 0)

    <div class="card mt-3">

        <div class="card-header">
            <h3 class="card-title">Product Images</h3>
        </div>

        <div class="card-body">

            <div class="row">

                @foreach($product->images as $image)

                    <div class="col-md-2 mb-3">

                        <img
                            src="{{ asset('storage/' . $image->image) }}"
                            class="img-fluid img-thumbnail"
                            style="height:120px; object-fit:cover;">

                        <form
                            action="{{ route('admin.product-images.destroy', $image->id) }}"
                            method="POST"
                            class="mt-2">

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                class="btn btn-danger btn-sm btn-block"
                                onclick="return confirm('Delete this image?')">

                                Delete

                            </button>

                        </form>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

@endif
</div>

@endsection