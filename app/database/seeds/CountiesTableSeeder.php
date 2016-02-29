<?php

class CountiesTableSeeder extends Seeder {

    public function run()
    {

        DB::table('counties')->delete();

        $counties = array(
            array(
                'name' => 'Zagrebačka',
                'region_id' => 1,
            ),
            array(
                'name' => 'Krapinsko-zagorska',
                'region_id' => 1,
            ),
            array(
                'name' => 'Sisačko-moslavačka',
                'region_id' => 1,
            ),
            array(
                'name' => 'Karlovačka',
                'region_id' => 1,
            ),
            array(
                'name' => 'Varaždinska',
                'region_id' => 1,
            ),

            array(
                'name' => 'Koprivničko-križevačka',
                'region_id' => 1,
            ),
            array(
                'name' => 'Bjelovarsko-bilogorska',
                'region_id' => 1,
            ),
            array(
                'name' => 'Primorsko-goranska',
                'region_id' => 4,
            ),
            array(
                'name' => 'Ličko-senjska',
                'region_id' => 4,
            ),
            array(
                'name' => 'Virovitičko-podravska',
                'region_id' => 1,
            ),
            array(
                'name' => 'Požeško-slavonska',
                'region_id' => 3,
            ),
            array(
                'name' => 'Brodsko-posavska',
                'region_id' => 3,
            ),

            array(
                'name' => 'Zadarska',
                'region_id' => 2,
            ),
            array(
                'name' => 'Osječko-baranjska',
                'region_id' => 3,
            ),
            array(
                'name' => 'Šibensko-kninska',
                'region_id' => 2,
            ),
            array(
                'name' => 'Vukovarsko-srijemska',
                'region_id' => 3,
            ),
            array(
                'name' => 'Splitsko-dalmatinska',
                'region_id' => 2,
            ),

            array(
                'name' => 'Istarska',
                'region_id' => 4,
            ),
            array(
                'name' => 'Dubrovačko-neretvanska',
                'region_id' => 2,
            ),
            array(
                'name' => 'Međimurska',
                'region_id' => 1,
            ),
            array(
                'name' => 'Grad Zagreb',
                'region_id' => 1,
            ),
        );


        DB::table('counties')->insert($counties);
    }

}