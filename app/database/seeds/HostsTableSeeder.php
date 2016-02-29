<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class HostsTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        for ($i = 0; $i < 3; $i++) {
            Host::create([
                'name' => 'Volonterski centar',
                'address' => 'Ilica 29, 10000 Zagreb',
                'contact_person' => 'Admin',
                'phone' => '+013013058',
                'web' => 'www.vcz.hr',
                'organization_type_id' => 1,
                'additional_note' => '',
                'user_id' => $i + 1,
            ]);
        }
    }

}