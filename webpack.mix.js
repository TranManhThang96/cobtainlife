const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */
 mix.js('resources/js/admin/app.js', 'public/js/admin')
 mix.sass('resources/sass/admin/app.scss', 'public/css/admin');

// [categories]
mix.js('resources/js/admin/categories/index', 'public/js/admin/categories');
mix.js('resources/js/admin/categories/add', 'public/js/admin/categories');
mix.sass('resources/sass/admin/categories/add.scss', 'public/css/admin/categories');