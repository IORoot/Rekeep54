<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration
{
    /**
     * Run the migration for a page.
     *
     * A page is what holds a collection of nodes.
     * There is one single page per menu item in the usermenu.
     *
     * @param int id Auto incrementing ID, Primary Key
     * @param string title
     * @param string background_hex Hexadecimal colour code reference for page background.
     * @param string background_image Image filename for the background of the page.
     * @param bool public Whether the page is viewable to the public or is private.
     * @param decimal rating A public rating value similar to IMDB metascore value.
     * @param string grid_direction ltr, rtl, ttb, btt (Left to right, right to left, top to bottom, bottom to top).
     * @param string grid_column_count Number of columns on the page. 1,2,3,4,5 or 6.
     * @param string grid_row_height Crop of image. Original, square, widescreen (16:9), landscape, portrait.
     * @param string page_order Order the nodes will be displayed. Chronological, alphabetical, popularity, random, freshest, custom.
     * @param string page_direction Direction of node order. Ascending or Descending.
     * @param string page_presentation Way the nodes are displayed. Grid, text, card, magazine, grouped, full.
     * @param string default_node_size The default width of each node on the page. 1,2,3,4,5 or 6.
     * @param string default_primary_hex The default primary hexadecimal colour of each node.
     * @param string default_secondary_hex The default secondary hexadecimal colour of each node.
     * @param int usermenu_id Foreign key id of the usermenu that the page is linked to.
     * @param timestamp created_at Timestamp that the node was created.
     * @param timestamp updated_at Timestamp that the node was updated last.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page', function (Blueprint $table) {

            // Setup Basics
            $table->increments('id')->unsigned()->index();
            $table->string('title')->deafult('New Page');
            $table->string('background_hex')->default('FFFFFF');
            $table->string('background_image')->nullable();
            $table->boolean('public')->default(false);
            $table->decimal('rating', 2, 1)->unsigned()->default(0);

            // Setup Grid
            $table->string('grid_direction')->default('ltr');
            $table->string('grid_column_count')->default('4');
            $table->string('grid_row_height')->default('square');

            // Setup Node View
            $table->string('page_filter')->default('chronological');
            $table->string('page_order')->default('desc');
            $table->string('page_presentation')->default('grid');

            // Setup Node Defaults
            $table->tinyInteger('default_node_size')->default('1');
            $table->string('default_primary_hex',6)->default('CCCCCC');
            $table->string('default_secondary_hex',6)->default('111111');

            // Setup Foreign Keys
            $table->integer('usermenu_id')->unsigned();

            // Setup Timestamps
            $table->timestamps();

            // Setup Foreign Key reference.
            $table->foreign('usermenu_id')->references('id')->on('usermenus')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('page');
    }
}
