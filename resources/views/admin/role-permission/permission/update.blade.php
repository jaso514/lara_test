<x-admin.update-base :entity="$entity" :action="'update'">
    <form action="{{ route('admin.permission.update', [$permission->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="">Permission Name</label>
            <input type="text" name="name" value="{{ $permission->name }}" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="">Guard Name</label>
            <input type="text" name="guard_name" value="{{ $permission->guard_name }}" class="form-control" />
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</x-admin.update-base>
