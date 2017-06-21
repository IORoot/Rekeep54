<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Faker\Factory as Faker;

class Level3MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run( $userAndUsermenu = null )
    {

        $newuser = $userAndUsermenu['newuser'];
        $newusermenu = $userAndUsermenu['newusersubmenu'];

        // Add a new menu item and give it the passed parent_id
        $newusersubmenu = $newuser->usermenu()->save(factory('App\Usermenu')->make(
            [
                'parent_id' => $newusermenu->id
            ]
        ));

        // Add Pages & Nodes to each new submenu created.
        $this->call('PageTableSeeder', $newusersubmenu);

        // Add between 0 to 4 level-3-menu items.
        for($submenus = 0; $submenus < rand(0,4); $submenus++) {

            // Add Pages & Nodes to each submenu.
            $this->call('Level4MenuTableSeeder', compact("newuser", "newusersubmenu") );

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



