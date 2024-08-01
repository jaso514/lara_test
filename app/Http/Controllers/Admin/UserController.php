<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class UserController extends BaseController
{

    public function __construct()
    {
        $this->setEntity('user');
        parent::__construct();
    }

    public function index()
    {
        $users = User::get();
        $head = $this->getHead();
        $this->response['head'] = array_merge(['Username', 'Name', 'Email', 'Roles'], $head);
        $this->response['users'] = $users;
        return view('admin.role-permission.user.view', $this->response);
    }

    public function create()
    {
        $this->response['roles'] = Role::pluck('name','name')->all();

        return view('admin.role-permission.user.create', $this->response);
    }

    public function store(Request $request)
    {
        $request->validate([
                'username' => 'required|string|min:4|max:16|unique:users,username|regex:/^[a-zA-Z0-9_]+$/',
                'name' => 'required|string|min:4|max:40|regex:/^[a-zA-Z\ ]+$/',
                'email' => 'required|email:rfc|max:255|unique:users,email|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
                'password' => 'required|string|min:8|max:32|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*+?&])[A-Za-z\d@$!%*+?&]{8,}$/',
                'role' => 'required'
            ]);

        $user = User::create([
                'username' => $request->username,
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

        $roleName = $request->roles[0]; // should be only one, is unique the role name
        $role = Role::where('name', $roleName)->first();
        $user->syncRoles($role);

        return redirect(route('admin.user.edit', [$user->id]))->with('status','User created successfully with roles');
    }

    public function edit(User $user)
    {
        $roles = Role::pluck('name','name')->all();

        $this->response['user'] = $user;
        $this->response['roles'] = $roles;
        $this->response['userRoles'] = $user->roles->pluck('name','name')->all();

        return view('admin.role-permission.user.update', $this->response);
    }

    public function update(Request $request, User $user)
    {
        $rules = [
            'username' => 'required|string|min:4|max:16|unique:users,username,'.$user->id.'|regex:/^[a-zA-Z0-9_]+$/',
            'name' => 'required|string|min:4|max:40|regex:/^[a-zA-Z\ ]+$/',
            'email' => 'required|email:rfc|max:255|unique:users,email,'.$user->id,
            'roles' => 'required'
        ];
        
        if(!empty($request->password)){
            $rules['password'] = 'required|string|min:8|max:32|regex:/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*+?&])[A-Za-z\d@$!%*+?&]{8,}$/';
        }

        $request->validate($rules);

        $data = [
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
        ];

        if(!empty($request->password)){
            $data += [
                'password' => Hash::make($request->password),
            ];
        }

        $user->update($data);

        $roleName = $request->roles[0]; // should be only one, is unique the role name
        $role = Role::where('name', $roleName)->first();
        $user->syncRoles($role);

        return redirect(route('admin.user.edit', [$user->id]))->with('status','User Updated Successfully with roles');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        return redirect(route('admin.user.index'))->with('status','User Delete Successfully');
    }
}
