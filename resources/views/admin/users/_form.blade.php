<div class="card-body">

    <div class="form-group">
        <label>Name</label>
        <input type="text"
               name="name"
               class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $user->name ?? '') }}">

        @error('name')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Email</label>
        <input type="email"
               name="email"
               class="form-control @error('email') is-invalid @enderror"
               value="{{ old('email', $user->email ?? '') }}">

        @error('email')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Phone</label>
        <input type="text"
               name="phone"
               class="form-control"
               value="{{ old('phone', $user->phone ?? '') }}">
    </div>

    <div class="form-group">
        <label>Password {{ isset($user) ? '(leave blank to keep old password)' : '' }}</label>
        <input type="password"
               name="password"
               class="form-control @error('password') is-invalid @enderror">

        @error('password')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-group">
        <label>Role</label>
        <select name="role" class="form-control @error('role') is-invalid @enderror">
            <option value="">Select Role</option>

            @foreach($roles as $roleName => $roleLabel)
                <option value="{{ $roleName }}"
                    @selected(old('role', isset($user) ? $user->roles->pluck('name')->first() : '') === $roleName)>
                    {{ ucfirst($roleLabel) }}
                </option>
            @endforeach
        </select>

        @error('role')
            <span class="invalid-feedback">{{ $message }}</span>
        @enderror
    </div>

    <div class="form-check">
        <input type="checkbox"
               name="status"
               class="form-check-input"
               id="status"
               @checked(old('status', $user->status ?? true))>

        <label class="form-check-label" for="status">
            Active
        </label>
    </div>

</div>

<div class="card-footer">
    <button type="submit" class="btn btn-primary">
        Save User
    </button>
</div>