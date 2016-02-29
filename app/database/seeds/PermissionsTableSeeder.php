<?php

class PermissionsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('permissions')->delete();

        $manageUsersPermission = Permission::create([
            'name' => 'manage_users',
            'display_name' => 'manage users',
            'created_at' => \Carbon\Carbon::now(),
        ]);

        $manageRolesPermission = Permission::create([
            'name' => 'manage_roles',
            'display_name' => 'manage roles',
            'created_at' => \Carbon\Carbon::now(),
        ]);

        DB::table('permission_role')->delete();

        /** @var Role $adminRole */
        $adminRole = Role::where('name', '=', 'admin')->first();
        $adminRole->attachPermission($manageUsersPermission);
        $adminRole->attachPermission($manageRolesPermission);
        $adminRole->save();

    }

}