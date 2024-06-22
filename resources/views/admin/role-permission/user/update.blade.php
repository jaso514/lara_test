<x-admin.update-base :entity="$entity" :action="'update'">
    <form action="{{ route('admin.user.update', [$user->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="">Username</label>
            <input type="text" name="username" value="{{ $user->username }}" class="form-control" />
            @error('username') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="">Name</label>
            <input type="text" name="name" value="{{ $user->name }}" class="form-control" />
            @error('name') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="">Email</label>
            <input type="text" name="email" readonly value="{{ $user->email }}" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="">Password</label>
            <input type="text" name="password" class="form-control" />
            @error('password') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <label for="">Roles</label>
            <select name="roles[]" class="form-control">
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                <option
                    value="{{ $role }}"
                    {{ in_array($role, $userRoles) ? 'selected':'' }}
                >
                    {{ $role }}
                </option>
                @endforeach
            </select>
            @error('roles') <span class="text-danger">{{ $message }}</span> @enderror
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</x-admin.update-base>
