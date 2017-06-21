<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class NodeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run($newpage = null)
    {

        for($i = 0; $i < rand(1,10); $i++) {

            $newpage->nodes()->save(factory('App\node')->make(
                [
                    // Add a single RSS Feed assigned to the Node.
                    'rssfeed_id' => factory(App\rssfeed::class)->create()->id
                ]
            ));

        }
    }
}
