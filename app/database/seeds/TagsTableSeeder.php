<?php

class TagsTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('tags')->delete();

        $users = array(
            array('name' => 'Djeca',),
            array('name' => 'Mladi',),
            array('name' => 'Stari i nemoćni',),
            array('name' => 'Osobe s teškoćama u razvoju',),
            array('name' => 'Zdravstvo',),
            array('name' => 'Zaštita okoliša',),
            array('name' => 'Umjetnost i kultura',),
            array('name' => 'Obrazovanje',),
            array('name' => 'Sport',),
        );

        DB::table('tags')->insert($users);
    }

}
