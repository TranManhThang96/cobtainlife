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
mix.js('resources/js/admin/dashboard.js', 'public/js/admin')
mix.sass('resources/sass/admin/app.scss', 'public/css/admin');

// [categories]
mix.js('resources/js/admin/categories/index', 'public/js/admin/categories');
mix.js('resources/js/admin/categories/add', 'public/js/admin/categories');
mix.sass('resources/sass/admin/categories/add.scss', 'public/css/admin/categories');

// [banners]
mix.js('resources/js/admin/cbanners/index', 'public/js/admin/cbanners');
mix.js('resources/js/admin/cbanners/add', 'public/js/admin/cbanners');
mix.sass('resources/sass/admin/cbanners/add.scss', 'public/css/admin/cbanners');

// [supplier]
mix.js('resources/js/admin/suppliers/index', 'public/js/admin/suppliers');
mix.js('resources/js/admin/suppliers/add', 'public/js/admin/suppliers');
mix.sass('resources/sass/admin/suppliers/add.scss', 'public/css/admin/suppliers');

// [brand]
mix.js('resources/js/admin/brands/index', 'public/js/admin/brands');
mix.js('resources/js/admin/brands/add', 'public/js/admin/brands');
mix.sass('resources/sass/admin/brands/add.scss', 'public/css/admin/brands');

// [customer]
mix.js('resources/js/admin/customers/index', 'public/js/admin/customers');
mix.js('resources/js/admin/customers/add', 'public/js/admin/customers');
mix.sass('resources/sass/admin/customers/add.scss', 'public/css/admin/customers');

// [news]
mix.js('resources/js/admin/news/index', 'public/js/admin/news');
mix.js('resources/js/admin/news/add', 'public/js/admin/news');
mix.sass('resources/sass/admin/news/add.scss', 'public/css/admin/news');
mix.sass('resources/sass/admin/news/index.scss', 'public/css/admin/news');

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

// [configs]
mix.js('resources/js/admin/configs/index', 'public/js/admin/configs');
mix.sass('resources/sass/admin/configs/index.scss', 'public/css/admin/configs');

// [coupons]
mix.js('resources/js/admin/coupons/add', 'public/js/admin/coupons');
mix.js('resources/js/admin/coupons/index', 'public/js/admin/coupons');


// WEB

// [WEB] product
mix.sass('resources/sass/web/products/index.scss', 'public/css/web/products');
mix.sass('resources/sass/web/products/detail.scss', 'public/css/web/products');
mix.js('resources/js/web/products/index.js', 'public/js/web/products');
mix.js('resources/js/web/products/detail.js', 'public/js/web/products');


// [WEB] common
mix.js('resources/js/web/common/local_storage.js', 'public/js/web/common');
mix.js('resources/js/web/common/cart.js', 'public/js/web/common');
mix.js('resources/js/web/common/utils.js', 'public/js/web/common');
mix.sass('resources/sass/web/app.scss', 'public/css/web');
mix.js('resources/js/web/app.js', 'public/js/web');

// [WEB] checkout
mix.js('resources/js/web/checkout.js', 'public/js/web');

// [WEB] wishlist
mix.js('resources/js/web/wishlist.js', 'public/js/web');
mix.sass('resources/sass/web/wishlist/products.scss', 'public/css/web/wishlist');

// [WEB] compare
mix.js('resources/js/web/compare.js', 'public/js/web');
mix.sass('resources/sass/web/compare/products.scss', 'public/css/web/compare');


// [WEB] blog
mix.js('resources/js/web/blog/detail.js', 'public/js/web/blog');