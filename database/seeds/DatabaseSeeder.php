<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Clear all previous entries in database tables.
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('rssfeeds')->delete();
        DB::table('node_page')->delete();
        DB::table('nodes')->delete();
        DB::table('page')->delete();
        DB::table('usermenus')->delete();
        DB::table('users')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');

        Model::unguard();

            $this->call(UsersTableSeeder::class);

        Model::reguard();
    }
}
