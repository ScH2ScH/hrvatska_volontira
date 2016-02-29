<?php

class RegionsTableSeeder extends Seeder {

	public function run()
	{

        DB::table('regions')->delete();

        $regions = array(
            array(
                'name' => 'Sjeverna',
            ),
            array(
                'name' => 'Južna',
            ),
            array(
                'name' => 'Istočna',
            ),
            array(
                'name' => 'Zapadna',
            )
        );

        DB::table('regions')->insert($regions);
	}

}