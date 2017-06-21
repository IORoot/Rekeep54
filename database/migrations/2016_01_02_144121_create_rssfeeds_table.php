<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRssfeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rssfeeds', function (Blueprint $table) {
            $table->increments('id')->unsigned()->index();
            $table->string('title')->nullable();
            $table->mediumText('rss_xml')->nullable();
            $table->timestamps();
        });

        Schema::table('nodes', function($table)
        {
            $table->integer('rssfeed_id')->unsigned()->nullable();
            $table->foreign('rssfeed_id')->references('id')->on('rssfeeds')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('nodes', function($table)
        {
            $table->dropForeign('nodes_rssfeed_id_foreign');
        });

        Schema::drop('rssfeeds');
    }
}
