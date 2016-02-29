<?php

use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();

        $users = array(
            array(
                'username'          => 'admin',
                'email'             => 'admin@example.org',
                'password'          => Hash::make('100$mzl2015'),
                'confirmed'         => 1,
                'confirmation_code' => md5(microtime() . Config::get('app.key')),
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime,
            ),
            array(
                'username'          => 'user',
                'email'             => 'user@example.org',
                'password'          => Hash::make('100$mzl2015'),
                'confirmed'         => 1,
                'confirmation_code' => md5(microtime() . Config::get('app.key')),
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime,
            ),
            array(
                'username'          => 'backend',
                'email'             => 'backend@example.org',
                'password'          => Hash::make('20Hrvatskavolontira15'),
                'confirmed'         => 1,
                'confirmation_code' => md5(microtime() . Config::get('app.key')),
                'created_at'        => new DateTime,
                'updated_at'        => new DateTime,
            )
        );

        DB::table('users')->insert($users);

    }

}
