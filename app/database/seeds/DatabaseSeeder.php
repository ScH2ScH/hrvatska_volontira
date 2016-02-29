<?php

class DatabaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        // Add calls to Seeders here
        $this->call('UsersTableSeeder');
        $this->call('RolesTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('RegionsTableSeeder');
        $this->call('CountiesTableSeeder');
        $this->call('CitiesTableSeeder');
        $this->call('OrganizationTypesTableSeeder');
        $this->call('HostsTableSeeder');
        $this->call('TagsTableSeeder');
        $this->call('ActionsTableSeeder');
        //$this->call('EventsTableSeeder');
        $this->call('HomepageTableSeeder');
    }

}
