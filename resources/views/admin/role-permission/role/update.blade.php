<x-admin.update-base :entity="$entity" :action="'update'">
    <form action="{{ route('admin.role.update', [$role->id]) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="">Role Name</label>
            <input type="text" name="name" value="{{ $role->name }}" class="form-control" @if ($role->name=='super-admin' || $role->name=='admin') readonly @endif />
            <small>Only alphanumeric with uppercase, the special characterss - and _. Without space.</small>
        </div>
        <div class="mb-3">
            @if ($role->name=='super-admin' || $role->name=='admin')
            <input type="text" name="guard_name" value="{{ $role->guard_name }}" class="form-control" @if ($role->name=='super-admin' || $role->name=='admin') readonly @endif />
            @else
            <x-adminlte-select2 name="guard_name" label="Guard name" required
                
                >
                <option value="">Select one option...</option>
                @foreach ($guards as $guard)
                <option value="{{ $guard }}" {{ $guard==$role->guard_name?'selected':'' }} >{{ $guard }}</option>
                @endforeach
            </x-adminlte-select2>
            @endif
        </div>

        <div class="mb-3">
            <div class="accordion" id="more-options">
                <div class="card">
                    <div class="card-header" id="headingOne">
                        <h2 class="mb-0">
                        <button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" 
                                aria-expanded="true" aria-controls="collapseOne">Permissions</button>
                        </h2>
                    </div>

                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#more-options">
                        <div class="card-body">
                        <!-- Begin section fields -->
                        @error('permission')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="row" id="guard_name_permissions">
                            @foreach ($permissions as $permission)
                            <div class="col-md-3" data-guard_name="{{ $permission->guard_name }}">
                                <label>
                                    <input
                                        type="checkbox"
                                        name="permission[]"
                                        value="{{ $permission->name }}"
                                        data-id="{{ $permission->id }}"
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
            <button type="submit" class="btn btn-primary">{{__('Save')}}</button>
        </div>
    </form>

    @push('js')
    <script>
    $(document).ready(function() {
        const loadedGuard = '{{ $role->guard_name }}';
        const loadedPermissions = [{{ implode(",", $rolePermissions) }}];
        let loadedPermissionsChanged = false;
        
        hideOptions(loadedGuard);

        function hideOptions(guardName) {
            let $hideOptions = $('#guard_name_permissions').find('div[data-guard_name!="' + guardName + '"]');
            $hideOptions.each(function(idx, element){
                $(element).hide();
                $(element).find('input[type="checkbox"]').prop('checked', false);
            });
        }

        function showOptions(guardName) {
            let $validOptions = $('#guard_name_permissions').find('div[data-guard_name="' + guardName + '"]');

            $validOptions.each(function(idx, element){
                $(element).show();
                $(element).find('input[type="checkbox"]').prop('checked', false);
            });
        }

        function checkOptions(guardName) {
            let $options = $('#guard_name_permissions').find('div[data-guard_name="' + guardName + '"] input[type="checkbox"]');
            $options.each(function (idx, element){
                if(loadedPermissions.includes($(element).data('id'))) {
                    $(element).prop('checked', true);
                }
            });
            loadedPermissions;
        }

        $('#guard_name').change(function() {
            let guardName = $('#guard_name').val();
            showOptions(guardName);
            hideOptions(guardName);
            if (guardName===loadedGuard && !loadedPermissionsChanged){
                console.log("la misma");
                checkOptions(guardName);
            }
        });

        $('#guard_name_permissions input[type="checkbox"]').change(function() {
            const gn = $('#guard_name').val();
            if (gn == loadedGuard) {
                console.log("cambia" + $(this).val());
                
                loadedPermissionsChanged = true;
            }
        });
    });
    </script>

    @endpush
</x-admin.update-base>
