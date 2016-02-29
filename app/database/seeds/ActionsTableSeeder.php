<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class ActionsTableSeeder extends Seeder
{

    public function run()
    {
        $faker = Faker::create();

        Action::create([
            'name' => 'Hrvatska volontira',
            'description' => 'Opis akcije hrvatska volontira',
            'start' => $faker->dateTimeThisMonth,
            'end' => $faker->dateTimeThisMonth]);

        /*Legacy test*/
        /*foreach (range(1, 10) as $index) {
            Action::create([
                'name' => $faker->word,
                'description' => $faker->sentence(),
                'start' => $faker->dateTimeThisMonth,
                'end' => $faker->dateTimeThisMonth,
            ]);*/
    }

}