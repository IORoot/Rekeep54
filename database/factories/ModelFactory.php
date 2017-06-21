<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/
use faker\provider\MaterialColoursGeneratorProvider;
use faker\provider\FontAwesomeGeneratorProvider;

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => Hash::make('password'),
        'remember_token' => str_random(10),
        'api_token' => str_random(60),
    ];
});

$factory->define(App\Usermenu::class, function (Faker\Generator $faker) {

    /* Custom FontAwesome.com Faker Provider */
    $faker->addProvider(new MaterialColoursGeneratorProvider($faker));
    $faker->addProvider(new FontAwesomeGeneratorProvider($faker));

//    $faker->addProvider(new Faker\Provider\FontAwesomeGeneratorProvider($faker));
//    $faker->addProvider(new Faker\Provider\MaterialDesignColours($faker));

    return [
        'title' => $faker->ColorName,
        'icon_name' => $faker->fontAwesomeIcon,
        'icon_hex' => $faker->MaterialColour,
        'public' => 0,
        'rating' => $faker->randomFloat(1, 0, 9.9)
    ];
});

$factory->define(App\Page::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->ColorName,
        'background_hex' => substr($faker->hexcolor, 1, 6),
        'grid_direction' => 'ltr',
        'grid_column_count' => '6',
        'grid_row_height' => 'original',
        'page_filter' => 'Chronological',
        'page_order' => 'desc',
        'page_presentation' => 'grid',
        'public' => false,
        'rating' => $faker->randomFloat(1, 0, 9.9),
        'default_node_size' => '1',
        'default_primary_hex' => 'CCCCCC',
        'default_secondary_hex' => '111111'
    ];
});

$factory->define(App\node::class, function (Faker\Generator $faker) {
    return [
        'node_type' => 'website',
        'title' => $faker->country,
        'url' => $faker->url,
        'description' => $faker->realText(200),
        'notes' => $faker->realText(100),
        'favicon_url' => $faker->url,
        'node_width' => 1,
        'node_height' => 1,
        'image_filename' => '/images/default/image.png',
        'colour_1_hex' => substr($faker->hexcolor, 1, 6),
        'colour_2_hex' => substr($faker->hexcolor, 1, 6),
        'colour_3_hex' => substr($faker->hexcolor, 1, 6),
        'colour_4_hex' => substr($faker->hexcolor, 1, 6),
        'colour_5_hex' => substr($faker->hexcolor, 1, 6),
        'twitter_link' => $faker->url,
        'facebook_link' => $faker->url,
        'youtube_link' => $faker->url,
        'instagram_link' => $faker->url,
        'click_count' => 0
    ];
});

$factory->define(App\rssfeed::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->domainWord,
        'rss_xml' => $faker->text(10)
    ];
});