<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsermenusTable extends Migration {

  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::create('usermenus', function(Blueprint $table) {
        // These columns are needed for Baum's Nested Set implementation to work.
        // Column names may be changed, but they *must* all exist and be modified
        // in the model.
        // Take a look at the model scaffold comments for details.
        // We add indexes on parent_id, lft, rgt columns by default.
        $table->increments('id');
        $table->integer('parent_id')->nullable()->index();
        $table->integer('lft')->nullable()->index();
        $table->integer('rgt')->nullable()->index();
        $table->integer('depth')->nullable();

        // Custom added fields for the users menu.

        $table->string('title')->default('New Folder');                         // Human-readable title of the menu item.
        $table->string('icon_name')->nullable()->default('fa-folder-open');     // ID of menu icon to use.
        $table->char('icon_hex', 6)->nullable()->default('FFFFFF');             // Hexadecimal Colour value of icon.
        $table->boolean('public')->nullable()->default(0);                      // Public or private page. public = 1.
        $table->decimal('rating', 2, 1)->unsigned()->default(0);                // 0.0 to 9.9 Rating value.
        $table->boolean('state')->default('0');                                 // Open or Closed. Default is closed.

        // Create foreign Key to user table

        $table->integer('user_id')->unsigned();
        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        // Timestamps
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
        Schema::drop('usermenus');
    }

}
