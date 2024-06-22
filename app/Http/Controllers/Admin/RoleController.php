<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
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
        $this->response['head'] = array_merge(['name', 'guard_name', 'created_at'], $head);
        $this->response['roles'] = $roles;

        return view('admin.role-permission.role.view', $this->response);
    }

    public function create()
    {
        return view('admin.role-permission.role.create', $this->response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        Role::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect(route('admin.role.index'))->with('status','Role Created Successfully');
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

        return view('admin.role-permission.role.update', $this->response);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,'.$role->id
            ],
            'guard_name' => [
                'required',
                'string'
            ]
        ]);

        $role->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        $request->validate([
            'permission' => 'required'
        ]);

        $role->syncPermissions($request->permission);

        return redirect(route('admin.role.edit', [$role->id]))->with('status','Role Updated Successfully');

    }

    public function destroy($roleId)
    {
        $role = Role::find($roleId);
        $role->delete();
        
        return redirect(route('admin.role.index'))->with('status','Role Deleted Successfully');
    }

}
