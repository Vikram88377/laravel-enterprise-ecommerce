<div class="card-body">

    <div class="form-group">
        <label>Coupon Code</label>
        <input type="text"
               name="code"
               class="form-control @error('code') is-invalid @enderror"
               value="{{ old('code', $coupon->code ?? '') }}"
               placeholder="SAVE10">

        @error('code')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Type</label>
        <select name="type" class="form-control @error('type') is-invalid @enderror">
            <option value="percentage"
                @selected(old('type', $coupon->type ?? '') === 'percentage')>
                Percentage
            </option>

            <option value="fixed"
                @selected(old('type', $coupon->type ?? '') === 'fixed')>
                Fixed
            </option>
        </select>

        @error('type')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Value</label>
        <input type="number"
               step="0.01"
               name="value"
               class="form-control @error('value') is-invalid @enderror"
               value="{{ old('value', $coupon->value ?? '') }}">

        @error('value')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Minimum Order Amount</label>
        <input type="number"
               step="0.01"
               name="min_order_amount"
               class="form-control"
               value="{{ old('min_order_amount', $coupon->min_order_amount ?? 0) }}">
    </div>

    <div class="form-group">
        <label>Maximum Discount</label>
        <input type="number"
               step="0.01"
               name="max_discount"
               class="form-control"
               value="{{ old('max_discount', $coupon->max_discount ?? '') }}">
    </div>

    <div class="form-group">
        <label>Start Date</label>
        <input type="datetime-local"
               name="start_date"
               class="form-control @error('start_date') is-invalid @enderror"
               value="{{ old('start_date', isset($coupon) ? $coupon->start_date->format('Y-m-d\TH:i') : '') }}">

        @error('start_date')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>End Date</label>
        <input type="datetime-local"
               name="end_date"
               class="form-control @error('end_date') is-invalid @enderror"
               value="{{ old('end_date', isset($coupon) ? $coupon->end_date->format('Y-m-d\TH:i') : '') }}">

        @error('end_date')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Usage Limit</label>
        <input type="number"
               name="usage_limit"
               class="form-control"
               value="{{ old('usage_limit', $coupon->usage_limit ?? '') }}">
    </div>

    <div class="form-check">
        <input type="checkbox"
               name="status"
               class="form-check-input"
               id="status"
               @checked(old('status', $coupon->status ?? true))>

        <label class="form-check-label" for="status">
            Active
        </label>
    </div>

</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">
        Save Coupon
    </button>
</div>