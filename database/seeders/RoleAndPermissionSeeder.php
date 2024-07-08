<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    private const PERMISSIONS = [
        'users', 'roles', 'applications'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'Admin']);

        foreach (self::PERMISSIONS as $permissionStr) {
            Permission::create(['name' => 'view-'.$permissionStr]);
            Permission::create(['name' => 'create-'.$permissionStr]);
            Permission::create(['name' => 'edit-'.$permissionStr]);
            Permission::create(['name' => 'delete-'.$permissionStr]);

            $adminRole->givePermissionTo([
                'view-'.$permissionStr,
                'create-'.$permissionStr,
                'edit-'.$permissionStr,
                'delete-'.$permissionStr,
            ]);
        }

        Permission::create(['name' => 'view-client-categories']);
        Permission::create(['name' => 'edit-client-categories']);
        
        $adminRole->givePermissionTo(['view-client-categories']);
        $adminRole->givePermissionTo(['edit-client-categories']);
    }
}
