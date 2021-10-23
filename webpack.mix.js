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

// [products]
mix.js('resources/js/admin/products/index', 'public/js/admin/products');
mix.js('resources/js/admin/products/add', 'public/js/admin/products');
mix.js('resources/js/admin/products/tinymce', 'public/js/admin/products');
mix.sass('resources/sass/admin/products/add.scss', 'public/css/admin/products');
mix.sass('resources/sass/admin/products/index.scss', 'public/css/admin/products');

// [orders]
mix.js('resources/js/admin/orders/index', 'public/js/admin/orders');
mix.js('resources/js/admin/orders/add', 'public/js/admin/orders');
mix.js('resources/js/admin/orders/products', 'public/js/admin/orders');
