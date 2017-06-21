<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Add two new users.
        factory('App\User')
            ->create(['email' => 'andy@parkourgenerations.com'])
            ->each(function($newuser) {

                // Add between 1 to 5 new root menu items to each new user
                for($i = 0; $i < rand(1,5); $i++) {

                    $this->call('MenuTableSeeder', $newuser);

                }
            });
        factory('App\User')
            ->create(['email' => 'blane@parkourgenerations.com'])
            ->each(function($newuser) {

                // Add between 1 to 5 new root menu items to each new user
                for($i = 0; $i < rand(1,5); $i++) {

                    $this->call('MenuTableSeeder', $newuser);

                }
            });
    }


    /**
     * Seed the given connection from the given path.
     *
     * @param  string  $class
     * @return void
     */
    public function call($class, $extra = null) {
        $this->resolve($class)->run($extra);
    }
};