<x-admin.update-base :entity="$entity" :action="'update'">
    <form action="{{ route('admin.role.update', [$role->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="">Role Name</label>
            <input type="text" name="name" value="{{ $role->name }}" class="form-control" />
        </div>
        <div class="mb-3">
            <label for="">Guard Name</label>
            <input type="text" name="guard_name" value="{{ $role->guard_name }}" class="form-control" />
        </div>

        <div class="mb-3">
            <div class="accordion" id="accordionExample">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" 
                                aria-expanded="true" aria-controls="collapseOne">Permissions</button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
                        <div class="card-body">
                        <!-- Begin section fields -->
                        @error('permission')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="row">
                            @foreach ($permissions as $permission)
                            <div class="col-md-3">
                                <label>
                                    <input
                                        type="checkbox"
                                        name="permission[]"
                                        value="{{ $permission->name }}"
                                        {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                    />
                                    {{ $permission->name }}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <!-- End section fields -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Update</button>
        </div>
    </form>
</x-admin.update-base>
