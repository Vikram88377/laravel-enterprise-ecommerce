<div class="card-body">

    <div class="form-group">

        <label>Category</label>

        <select
            name="category_id"
            class="form-control">

            @foreach($categories as $category)

                <option
                    value="{{ $category->id }}"
                    @selected(old('category_id',$product->category_id ?? '')==$category->id)>

                    {{ $category->name }}

                </option>

            @endforeach

        </select>

    </div>

    <div class="form-group">

        <label>Name</label>

        <input
            type="text"
            name="name"
            class="form-control"
            value="{{ old('name',$product->name ?? '') }}">

    </div>

    <div class="form-group">

        <label>SKU</label>

        <input
            type="text"
            name="sku"
            class="form-control"
            value="{{ old('sku',$product->sku ?? '') }}">

    </div>

    <div class="form-group">

        <label>Price</label>

        <input
            type="number"
            step="0.01"
            name="price"
            class="form-control"
            value="{{ old('price',$product->price ?? '') }}">

    </div>

    <div class="form-group">

        <label>Sale Price</label>

        <input
            type="number"
            step="0.01"
            name="sale_price"
            class="form-control"
            value="{{ old('sale_price',$product->sale_price ?? '') }}">

    </div>

    <div class="form-group">

        <label>Stock</label>

        <input
            type="number"
            name="stock"
            class="form-control"
            value="{{ old('stock',$product->stock ?? '') }}">

    </div>

    <div class="form-group">

        <label>Description</label>

        <textarea
            name="description"
            class="form-control"
            rows="5">{{ old('description',$product->description ?? '') }}</textarea>

    </div>

    <div class="form-group">
    <label>Product Images</label>

    <input
        type="file"
        name="images[]"
        class="form-control"
        multiple>
</div>

    <div class="form-check">

        <input
            type="checkbox"
            class="form-check-input"
            name="status"
            value="1"
            @checked(old('status',$product->status ?? true))>

        <label class="form-check-label">

            Active

        </label>

    </div>

</div>

<div class="card-footer">

    <button
        class="btn btn-success">

        Save Product

    </button>

</div>