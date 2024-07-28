<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Admin\BaseController;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;


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
        $this->response['head'] = array_merge([trans('admin.name'), trans('admin.guard_name'), trans('admin.created_at')], $head);
        $this->response['permissions'] = $permissions;

        return view('admin.role-permission.permission.view', $this->response);
    }

    public function create()
    {
        $this->response['guards'] = config('auth.guards') ? array_keys(config('auth.guards')) : ['web'];
        return view('admin.role-permission.permission.create', $this->response);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9_\ ]+$/|unique:permissions,name|min:4|max:16',
            'guard_name' => 'required|string'
        ]);

        $permission = Permission::create([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect(route('admin.permission.edit', [$permission->id]))->with('status','Permission Created Successfully');
    }

    public function edit(Permission $permission)
    {
        $this->response['permission'] = $permission;
        $this->response['guards'] = config('auth.guards') ? array_keys(config('auth.guards')) : ['web'];
        return view('admin.role-permission.permission.update', $this->response);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => 'required|regex:/^[a-zA-Z0-9_\ ]+$/|unique:permissions,name,' . $permission->id . '|min:4|max:16',
            'guard_name' => 'required|string'
        ]);

        $permission->update([
            'name' => $request->name,
            'guard_name' => $request->guard_name,
        ]);

        return redirect(route('admin.permission.edit', [$permission->id]))->with('status','Permission Updated Successfully');
    }

    public function destroy($permissionId)
    {
        try {
            $permission = Permission::findOrFail($permissionId);
            if ($permission) {
                $permission->delete();
                return redirect(route('admin.permission.index'))->with('status','Permission Deleted Successfully');        
            }
        } catch (\Exception $e) {
            dd($e);
            return redirect(route('admin.permission.index'))->with('status','Permission Couldn\'t be deleted Successfully');
        }
    }
}
