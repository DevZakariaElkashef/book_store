<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
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
        $adminRole = Role::firstOrCreate(['name' => 'super-admin']);
        $admin->assignRole($adminRole);

        $permissions = [
            'users',
            'roles',
            'permissions',
            'contact_types',
            'contacts',
            'universities',
            'colleges',
            'subjects',
            'books',
            'coupons',
            'cities',
            'orders',
            'book_reviews',
            'settings'
        ];

        $actions = [
            'read',
            'create',
            'update',
            'delete',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            foreach ($actions as $action) {
                $name = $permission . '.' . $action;
                Permission::firstOrCreate(['name' => $name]);
            }
        }

        // Collect all permission IDs
        $allPermissions = Permission::all();

        // Assign the permissions to the role
        $adminRole->syncPermissions($allPermissions);
    }
}
