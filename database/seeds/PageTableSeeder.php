<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     */
    public function run( $newusermenu = null )
    {

        // Add a single Page to a menu Leaf that has been passed.
        $newpage = $newusermenu->page()->save(factory('App\Page')->make(
            [
                'title' => $newusermenu->title,
                'background_hex' => $newusermenu->icon_hex,
                'rating' => $newusermenu->rating,
                'usermenu_id' => $newusermenu->id
            ]
        ));

        // Add a single Node to the Page.
        $this->call('NodeTableSeeder', $newpage);
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
}