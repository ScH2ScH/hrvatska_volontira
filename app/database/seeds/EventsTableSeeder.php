<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;
use Models\Event;

class EventsTableSeeder extends \Seeder
{

    public function run()
    {
        $faker = Faker::create();
        $cityCount = DB::table('cities')->count();

        $tagCount = DB::table('tags')->count();

        foreach (range(1, 100) as $index) {
            $start = \Carbon\Carbon::createFromTimestamp($faker->dateTimeThisMonth->getTimestamp())->toDateTimeString();
            $end = \Carbon\Carbon::parse($start)->addDays(7)->toDateTimeString();

            $event = new Event;
            $event->name = $faker->word;
            $event->description = $faker->sentence();
            $event->estimated_volunteers_no = rand(1, 100);
            $event->start = $start;
            $event->end = $end;
            $event->working_hours = $faker->sentence();
            $event->total_hours = rand(1, 150);
            $event->address = $faker->address;
            $event->email = $faker->email;
            $event->city_id = rand(1, $cityCount);
            $event->contact_person = $faker->name;
            $event->phone = $faker->phoneNumber;
            $event->additional_note = $faker->sentence();
            $event->action_id = 1;
            $event->host_id = rand(1, 10);


            $event->final_estimated_volunteers_no = rand(1, 100);
            $event->final_total_hours = rand(1, 150);
            $event->final_report = $faker->word;

            if ($event->save()) {

                /**
                 * Tags seed
                 */
                $tags = array();
                for ($i = 1; $i <= $tagCount; $i++) {
                    if (rand() % 2) {
                        $tags[] = Tag::find($i);
                    }
                }

                $event->tags()->saveMany($tags);
                $event->save();
            }
        }
    }
}
