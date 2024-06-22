<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use Spatie\Permission\Models\Permission;

class PermissionController extends BaseController
{
    public function __construct()
    {
        $this->setEntity('permission');
        parent::__construct();
    }

    public function index()
    {
        $permissions = Permission::get();
        $head = $this->getHead();
        $this->response['head'] = array_merge(['name', 'guard_name', 'created_at'], $head);
        $this->response['permissions'] = $permissions;

        return view('admin.role-permission.permission.view', $this->response);
    }

    public function create()
    {
        return view('admin.role-permission.permission.create', $this->response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ],
            'guard_name' => [
                'required',
                'string'            ]
        ]);

        Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect(route('admin.permission.index'))->with('status','Permission Created Successfully');
    }

    public function edit(Permission $permission)
    {
        $this->response['permission'] = $permission;
        return view('admin.role-permission.permission.update', $this->response);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ],
            'guard_name' => [
                'required',
                'string'
            ]
        ]);

        $permission->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect(route('admin.permission.edit', [$permission->id]))->with('status','Permission Updated Successfully');
    }

    public function destroy($permissionId)
    {
        $permission = Permission::find($permissionId);
        $permission->delete();
        return redirect(route('admin.permission.index'))->with('status','Permission Deleted Successfully');
    }
}
