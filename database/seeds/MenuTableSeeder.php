<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run( $newuser = null )
    {
            // Create the new menu item.
            $newusermenu = $newuser->usermenu()->save(factory('App\Usermenu')->make());

            // Add Pages & Nodes to each submenu by calling the PageTableSeeder.
            $this->call('PageTableSeeder', $newusermenu);

            // Add between 0 to 4 sub-menu items.
            for($submenus = 0; $submenus < rand(0,4); $submenus++) {

                // Add Pages & Nodes to each submenu.
                $this->call('Level2MenuTableSeeder', compact("newuser", "newusermenu") );

            }

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



