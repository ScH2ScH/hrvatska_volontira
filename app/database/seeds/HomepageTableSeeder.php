<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class HomepageTableSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        Homepage::create([
            'title' => "Naslov općenitog teksta o manifestaciji",
            'subtitle' => "Naslov o ovogodišnjoj akciji",
            'general' => "Općeniti podaci o akciji, tekst",
            'specific' => "Tekst o ovogodišnjoj akciji",
            'active' => 1,
        ]);
    }

}