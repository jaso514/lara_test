<x-admin.update-base :entity="$entity" :action="'update'">
    <form action="{{ route('admin.permission.update', [$permission->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="">Permission Name</label>
            <input type="text" name="name" value="{{ $permission->name }}" class="form-control" />
        </div>
        <div class="mb-3">
            <x-adminlte-select2 name="guard_name" label="Guard name" required>
                <option value="">Select one option...</option>
                @foreach ($guards as $guard)
                <option value="{{ $guard }}" {{ $guard==$permission->guard_name?'selected':'' }} >{{ $guard }}</option>
                @endforeach
            </x-adminlte-select2>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</x-admin.update-base>
