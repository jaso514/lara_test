<x-admin.create-base :entity="$entity" :action="'update'">
    <form action="{{ route('admin.permission.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="">Permission Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
        </div>
        <div class="mb-3">
            <label for="">Guard name</label>
            <input type="text" name="guard_name" class="form-control" value="{{ old('guard_name') }}"/>
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Save</button>
        </div>
    </form>
</x-admin.create-base>
