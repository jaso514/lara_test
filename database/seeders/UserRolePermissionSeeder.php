<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserRolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'view',
            'create',
            'update',
            'delete',
        ];
        $entities = [
            'role',
            'permission',
            'user'
        ];
        // Create Permissions
        foreach ($entities as $entity) {
            foreach ($permissions as $permission) {
                Permission::create(['name' => "$entity $permission", 'guard_name' => 'admin']);
            }
        }

        // Create Roles
        $superAdminRole = Role::create(['name' => 'super-admin']); //as super-admin
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => 'admin']);
        $staffRole = Role::create(['name' => 'staff', 'guard_name' => 'admin']);

        // Lets give all permission to super-admin, admin role.
        $allPermissionNames = Permission::pluck('name')->toArray();

        $superAdminRole->givePermissionTo($allPermissionNames);
        $adminRole->givePermissionTo($allPermissionNames);


        // Let's Create User and assign Role to it.

        $superAdminUser = User::firstOrCreate([
                    'email' => 'superadmin@gmail.com',
                ], [
                    'name' => 'Super Admin',
                    'username' => 'super_admin',
                    'email' => 'superadmin@gmail.com',
                    'password' => Hash::make ('sa234567!'),
                ]);

        $superAdminUser->assignRole($superAdminRole);


        $adminUser = User::firstOrCreate([
                    'email' => 'admin@gmail.com'
                ], [
                    'name' => 'Admin',
                    'username' => 'admin',
                    'email' => 'admin@gmail.com',
                    'password' => Hash::make ('a234567!'),
                ]);

        $adminUser->assignRole($adminRole);


        $staffUser = User::firstOrCreate([
                    'email' => 'staff@gmail.com',
                ], [
                    'name' => 'Staff',
                    'username' => 'staff',
                    'email' => 'staff@gmail.com',
                    'password' => Hash::make('s234567!'),
                ]);

        $staffUser->assignRole($staffRole);
    }
}
