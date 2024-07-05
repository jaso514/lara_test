<x-admin.create-base :entity="$entity" :action="'update'">
    <form action="{{ route('admin.user.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="">Username</label>
            <input type="text" name="username" class="form-control" value="{{ old('username') }}" />
            <small>The user may have alphanumeric with upper and lower case, also can accept the special char "_"</small>
        </div>
        <div class="mb-3">
            <label for="">Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
        </div>
        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" name="email" class="form-control" value="{{ old('email') }}"/>
        </div>
        <div class="mb-3">
            <label for="">Password</label>
            <input type="password" name="password" class="form-control" />
            <small>The password may have alphanumeric characters with any of these special chars: @, $, !, %, *, +, ?, &.</small>
        </div>
        <div class="mb-3">
            <label for="">Roles</label>
            <select name="role" class="form-control">
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                <option value="{{ $role }}"
                    {{ (old("role")===$role) ? 'selected':'' }}>
                    {{ $role }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</x-admin.create-base>