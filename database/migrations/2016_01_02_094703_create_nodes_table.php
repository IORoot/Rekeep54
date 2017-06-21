<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNodesTable extends Migration
{
    /**
     * Run the UP migration for a node.
     *
     * The node is a single entity that represents one saved item from the user.
     * This is primarily a website bookmark, but can be a note, to-do list, widget, etc...
     * A node can be on multiple pages (node_page pivot table).
     * Multiple nodes can be on a page (page table).
     *
     * @param int id Primary key identifier for a node.
     * @param string node_type The type of node being displayed. Website, Widget, image, video, to-do, text, audio, table, document, storage
     * @param string title Readable identifier for the node.
     * @param string url source link of node.
     * @param longtext description text description of the node.
     * @param longtext notes extra user notes of the node.
     * @param string favicon_url source link of the favicon for the website.
     * @param string image_filename filename on server for the saved image that represents node.
     * @param string image_filter filter name of CSS image adjustments (b&w, vibrant, etc..)
     * @param string image_scale whether to scale, fit, stretch or crop image for node.
     * @param string image_crop X,Y,Width,Height Crop details for image.
     * @param string node_width number of columns for node to use up.
     * @param string node_height number of rows for node to use up.
     * @param string node_position user custom position order of node.
     * @param string primary_hex override primary hexadecimal colour of node.
     * @param string secondary_hex override secondary hexadecimal colour of node.
     * @param string twitter_link URL address to node's twitter account.
     * @param string facebook_link URL address to node's facebook account.
     * @param string youtube_link URL address to node's youtube account.
     * @param string instagram_link URL address to node's instagram account.
     * @param int click_count count of number of times the user has clicked on this node's link.
     * @param int user_id foreign key id to user table for node.
     * @param timestamp created_at when the node was created.
     * @param timestamp updated_at when the node was last updated.
     * @param int rssfeed_id foreign key id to RSS feed table for node.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nodes', function (Blueprint $table) {

            // Setup Basics
            $table->increments('id')->unsigned()->index();
            $table->string('node_type')->default('website');
            $table->string('title')->nullable()->default('New Node');
            $table->string('url')->nullable()->default('http://rekeep.com');
            $table->longtext('description')->nullable();
            $table->longtext('notes')->nullable();
            $table->string('favicon_url')->nullable();

            // Setup Node Image
            $table->string('image_filename')->nullable()->default('/images/default/image.png');
            $table->string('image_filter')->nullable();
            $table->string('image_scale')->nullable();
            $table->string('image_crop')->nullable();
            $table->string('image_animated')->nullable();
            $table->string('image_width')->nullable();
            $table->string('image_height')->nullable();

            // Setup Node Box
            $table->smallInteger('node_width')->nullable();
            $table->smallInteger('node_height')->nullable();
            $table->tinyInteger('node_position')->nullable();

            // Setup Node Colours
            $table->string('colour_1_hex',6)->nullable();
            $table->string('colour_2_hex',6)->nullable();
            $table->string('colour_3_hex',6)->nullable();
            $table->string('colour_4_hex',6)->nullable();
            $table->string('colour_5_hex',6)->nullable();

            // Setup Social Media Links
            $table->string('twitter_link')->nullable();
            $table->string('facebook_link')->nullable();
            $table->string('youtube_link')->nullable();
            $table->string('instagram_link')->nullable();

            // Setup Statistics
            $table->integer('click_count')->default(0);

            // Setup Timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * Drops the nodes table.
     *
     * @return void
     */
    public function down()
    {


        Schema::drop('nodes');
    }
}
