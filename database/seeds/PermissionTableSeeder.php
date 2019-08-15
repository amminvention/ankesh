<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',
            'sale-type-list',
            'sale-type-create',
            'sale-type-edit',
            'sale-type-delete',
            'vehicle-record-list',
            'vehicle-record-create',
            'vehicle-record-edit',
            'vehicle-record-delete',
            'settings',
        ];


        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }

}
