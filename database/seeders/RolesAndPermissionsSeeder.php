<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Créer des permissions
        Permission::create(['name' => 'create books']);
        Permission::create(['name' => 'edit books']);
        Permission::create(['name' => 'delete books']);

        // Créer des rôles et leur attribuer des permissions
        $roleAdmin = Role::create(['name' => 'Admin']);
        $roleAdmin->givePermissionTo(['create books', 'edit books', 'delete books']);

        $roleUser = Role::create(['name' => 'User']);
        $roleUser->givePermissionTo(['create books']);
    }
}
