<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodePageTable extends Migration
{
    /**
     * Run the migration for pivot table node_page.
     *
     * @param integer node_id foreign key id for a node
     * @param integer page_id foreign key id for a page
     *
     * @return void
     */
    public function up()
    {
        Schema::create('node_page', function (Blueprint $table) {
            $table->integer('node_id')->unsigned()->index();
            $table->foreign('node_id')->references('id')->on('nodes')->onDelete('cascade');

            $table->integer('page_id')->unsigned()->index();
            $table->foreign('page_id')->references('id')->on('page')->onDelete('cascade');

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('node_page');
    }
}
