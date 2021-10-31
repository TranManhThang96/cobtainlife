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

// [order-status]
mix.js('resources/js/admin/order_status/index', 'public/js/admin/order_status');
mix.js('resources/js/admin/order_status/add', 'public/js/admin/order_status');
mix.js('resources/js/admin/order_status/edit', 'public/js/admin/order_status');

// [shipping-status]
mix.js('resources/js/admin/shipping_status/index', 'public/js/admin/shipping_status');
mix.js('resources/js/admin/shipping_status/add', 'public/js/admin/shipping_status');
mix.js('resources/js/admin/shipping_status/edit', 'public/js/admin/shipping_status');


// [payment-status]
mix.js('resources/js/admin/payment_status/index', 'public/js/admin/payment_status');
mix.js('resources/js/admin/payment_status/add', 'public/js/admin/payment_status');
mix.js('resources/js/admin/payment_status/edit', 'public/js/admin/payment_status');

// [weight class]
mix.js('resources/js/admin/weight_class/index', 'public/js/admin/weight_class');
mix.js('resources/js/admin/weight_class/add', 'public/js/admin/weight_class');
mix.js('resources/js/admin/weight_class/edit', 'public/js/admin/weight_class');

// [length class]
mix.js('resources/js/admin/length_class/index', 'public/js/admin/length_class');
mix.js('resources/js/admin/length_class/add', 'public/js/admin/length_class');
mix.js('resources/js/admin/length_class/edit', 'public/js/admin/length_class');

// [tax]
mix.js('resources/js/admin/tax/index', 'public/js/admin/tax');
mix.js('resources/js/admin/tax/add', 'public/js/admin/tax');
mix.js('resources/js/admin/tax/edit', 'public/js/admin/tax');

// [attribute group]
mix.js('resources/js/admin/attribute_group/index', 'public/js/admin/attribute_group');
mix.js('resources/js/admin/attribute_group/add', 'public/js/admin/attribute_group');
mix.js('resources/js/admin/attribute_group/edit', 'public/js/admin/attribute_group');


// WEB
mix.sass('resources/sass/web/app.scss', 'public/css/web');
mix.sass('resources/sass/web/products/index.scss', 'public/css/web/products');
mix.sass('resources/sass/web/products/detail.scss', 'public/css/web/products');
mix.js('resources/js/web/products/index.js', 'public/js/web/products');
mix.js('resources/js/web/products/detail.js', 'public/js/web/products');
mix.js('resources/js/web/app.js', 'public/js/web');
mix.js('resources/js/web/checkout.js', 'public/js/web');

// [WEB] common
mix.js('resources/js/web/common/local_storage.js', 'public/js/web/common');
mix.js('resources/js/web/common/cart.js', 'public/js/web/common');
mix.js('resources/js/web/common/utils.js', 'public/js/web/common');