<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class OrganizationTypesTableSeeder extends Seeder
{

    public function run()
    {
        OrganizationType::create(['name' => 'udruga']);
        OrganizationType::create(['name' => 'obrazovna ustanova']);
        OrganizationType::create(['name' => 'druga javna ustanova']);
        OrganizationType::create(['name' => 'državna ili lokalna tijela uprave']);
        OrganizationType::create(['name' => 'druga neprofitna organizacija']);
    }

}