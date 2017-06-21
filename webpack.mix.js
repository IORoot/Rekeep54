const { mix } = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copy('node_modules/vue/dist/vue.js', 'resources/assets/js/libs/vue.js');
mix.copy('node_modules/vue-resource/dist/vue-resource.js', 'resources/assets/js/libs/vue-resource.js');
mix.copy('node_modules/jquery/dist/jquery.js', 'resources/assets/js/libs/jquery.js');
mix.copy('node_modules/font-awesome/css/font-awesome.css', 'public/css/font-awesome.css');
mix.copyDirectory('node_modules/font-awesome/fonts', 'public/fonts');

mix.js(
    [
        'resources/assets/js/main.js',
        'resources/assets/js/libs/vue-resource.js',
        'resources/assets/js/libs/vue.js',
        'resources/assets/js/libs/jquery.js'
    ], 'public/js')
   .sass('resources/assets/sass/global.scss', 'public/css');
