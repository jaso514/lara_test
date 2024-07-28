<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use App\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RoleController extends BaseController
{
    public function __construct()
    {
        $this->setEntity('role');
        parent::__construct();
    }

    public function index()
    {
        $roles = Role::get();
        $head = $this->getHead();
        $this->response['head'] = array_merge([trans('admin.name'), trans('admin.guard_name'), trans('admin.created_at')], $head);
        $this->response['roles'] = $roles;

        return view('admin.role-permission.role.view', $this->response);
    }

    public function create()
    {
        $this->response['guards'] = Role::getDefaultGuards();
        return view('admin.role-permission.role.create', $this->response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name|min:2|max:16|regex:/^[a-zA-Z0-9_-]+$/',
            'guard_name' => 'required|string'
        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        $this->clearCache();

        return redirect(route('admin.role.edit', [$role->id]))->with('status','Role Created Successfully');
    }

    public function edit(Role $role)
    {
        $this->response['role'] = $role;

        $permissions = Permission::get();
        $rolePermissions = DB::table('role_has_permissions')
                ->where('role_has_permissions.role_id', $role->id)
                ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
                ->all();

        $this->response['permissions'] = $permissions;
        $this->response['rolePermissions'] = $rolePermissions;
        $this->response['guards'] = config('auth.guards') ? array_keys(config('auth.guards')) : ['web'];

        return view('admin.role-permission.role.update', $this->response);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|string|unique:roles,name,' . $role->id . '|min:4|max:16|regex:/^[a-zA-Z0-9_-]+$/',
            'guard_name' => 'required|string'
        ]);

        // prevent change name or guard name 
        if ($role->name != ROLE::RESERVED_ROLE_NAME['admin'] && $role->name != ROLE::RESERVED_ROLE_NAME['super-admin']) {
            $role->update([
                'name' => $request->name,
                'guard_name' => $request->guard_name,
            ]);
        }

        $request->validate([
            'permission' => 'array|exists:permissions,name',
        ]);

        $selectedPermissions = $request->input('permission');
        if ($selectedPermissions) {
            $roleGuardName = $role->guard_name;
            $permissions = Permission::whereIn('name', $selectedPermissions)->where('guard_name', $roleGuardName)->get();
    
            if ($permissions->count()!=count($selectedPermissions)) {
                return redirect(route('admin.role.edit', [$role->id]))
                    ->with('warning', 'You have to select the permission with the same guard name as the role. Contact support if the error persist.');
            }    
        }
        $role->syncPermissions($request->permission);

        $this->clearCache();

        return redirect(route('admin.role.edit', [$role->id]))->with('status','Role Updated Successfully');

    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->deleteOrFail();
        $this->clearCache();
        
        return redirect(route('admin.role.index'))->with('status','Role Deleted Successfully');
    }

}
