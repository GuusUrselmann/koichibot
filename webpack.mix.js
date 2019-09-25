const mix = require('laravel-mix');

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

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css');

mix.sass('resources/sass/grid.scss', 'public/css');

mix.sass('resources/sass/layout_admin.scss', 'public/css');
mix.sass('resources/sass/admin_blocks.scss', 'public/css');

mix.js('resources/js/behaviour_admin.js', 'public/js');
mix.js('resources/js/tableControls.js', 'public/js')
