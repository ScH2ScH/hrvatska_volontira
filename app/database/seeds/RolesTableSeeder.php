<?php

class RolesTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('roles')->delete();

        $adminRole = Role::create([
            'name'       => 'admin',
            'created_at' => \Carbon\Carbon::now(),
        ]);

        $userRole = Role::create([
            'name'       => 'user',
            'created_at' => \Carbon\Carbon::now(),
        ]);

        $backendRole = Role::create([
            'name'       => 'backend',
            'created_at' => \Carbon\Carbon::now(),
        ]);

        $user = User::where('username', '=', 'admin')->first();
        $user->attachRole($adminRole);

        $user = User::where('username', '=', 'user')->first();
        $user->attachRole($userRole);

        $user = User::where('username', '=', 'backend')->first();
        $user->attachRole($backendRole);
    }

}
