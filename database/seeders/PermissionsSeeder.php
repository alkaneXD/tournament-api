<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create default permissions
        Permission::create(['name' => 'list fights']);
        Permission::create(['name' => 'view fights']);
        Permission::create(['name' => 'create fights']);
        Permission::create(['name' => 'update fights']);
        Permission::create(['name' => 'delete fights']);

        Permission::create(['name' => 'list groups']);
        Permission::create(['name' => 'view groups']);
        Permission::create(['name' => 'create groups']);
        Permission::create(['name' => 'update groups']);
        Permission::create(['name' => 'delete groups']);

        Permission::create(['name' => 'list players']);
        Permission::create(['name' => 'view players']);
        Permission::create(['name' => 'create players']);
        Permission::create(['name' => 'update players']);
        Permission::create(['name' => 'delete players']);

        Permission::create(['name' => 'list rounds']);
        Permission::create(['name' => 'view rounds']);
        Permission::create(['name' => 'create rounds']);
        Permission::create(['name' => 'update rounds']);
        Permission::create(['name' => 'delete rounds']);

        Permission::create(['name' => 'list tournaments']);
        Permission::create(['name' => 'view tournaments']);
        Permission::create(['name' => 'create tournaments']);
        Permission::create(['name' => 'update tournaments']);
        Permission::create(['name' => 'delete tournaments']);

        // Create user role and assign existing permissions
        $currentPermissions = Permission::all();
        $userRole = Role::create(['name' => 'user']);
        $userRole->givePermissionTo($currentPermissions);

        // Create admin exclusive permissions
        Permission::create(['name' => 'list roles']);
        Permission::create(['name' => 'view roles']);
        Permission::create(['name' => 'create roles']);
        Permission::create(['name' => 'update roles']);
        Permission::create(['name' => 'delete roles']);

        Permission::create(['name' => 'list permissions']);
        Permission::create(['name' => 'view permissions']);
        Permission::create(['name' => 'create permissions']);
        Permission::create(['name' => 'update permissions']);
        Permission::create(['name' => 'delete permissions']);

        Permission::create(['name' => 'list users']);
        Permission::create(['name' => 'view users']);
        Permission::create(['name' => 'create users']);
        Permission::create(['name' => 'update users']);
        Permission::create(['name' => 'delete users']);

        // Create admin role and assign all permissions
        $allPermissions = Permission::all();
        $adminRole = Role::create(['name' => 'super-admin']);
        $adminRole->givePermissionTo($allPermissions);

        $user = \App\Models\User::whereEmail('admin@admin.com')->first();

        if ($user) {
            $user->assignRole($adminRole);
        }
    }
}
