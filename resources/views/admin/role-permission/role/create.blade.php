<x-admin.create-base :entity="$entity" :action="'update'">
    <form action="{{ route('admin.role.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="">Role Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
        </div>
        <div class="mb-3">
            <x-adminlte-select2 name="guard_name" label="Guard name" required>
                <option value="">Select one option...</option>
                @foreach ($guards as $guard)
                <option value="{{ $guard }}">{{ $guard }}</option>
                @endforeach
            </x-adminlte-select2>
        </div>

        <div class="mb-3">
            <button type="submit" class="btn btn-primary">{{__('admin.Save')}}</button>
        </div>
    </form>
</x-admin.create-base>