<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::first();
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $admin->assignRole($adminRole);


        $permissoins = [
            'users',
            'roles',
            'permissions'
        ];

        $actions = [
            'read',
            'create',
            'update',
            'delete',
        ];

        // create permissions
        foreach ($permissoins as $permisson) {
            foreach ($actions as $action) {
                $name = $permisson . '.' . $action;
                $item = \Spatie\Permission\Models\Permission::create(['name' => $name]);
            }
        }


        // assign the permissions to role
        foreach(Permission::all() as $permission) {
            $adminRole->syncPermissions($permission);
        }
    }
}
