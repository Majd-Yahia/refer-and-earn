<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (config('config.permissions') as $key => $permissions) {
            foreach ($permissions as $per) {
                Permission::create([ 'name' =>  $per['name'], 'display_name' => $per['display_name'], 'category' => $key ]);
            }
        }

        foreach (config('config.roles') as $key => $permissions) {
            $role = Role::create([ 'name' => $key]);

            if(in_array("all", $permissions))
            {
                foreach (config('config.permissions') as $key => $permissions) {
                    foreach ($permissions as $per) {
                        $role->givePermissionTo($per['name']);
                    }
                }
            }
            else
            {
                $role->givePermissionTo($permissions);
            }

        }

    }
}
