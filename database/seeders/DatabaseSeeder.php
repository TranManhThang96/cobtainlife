<?php

namespace Database\Seeders;

use App\Models\ShopLengthClass;
use App\Models\ShopOrder;
use App\Models\ShopOrderStatus;
use App\Models\ShopPaymentStatus;
use App\Models\ShopShippingStatus;
use App\Models\ShopWeightClass;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserManagersTableSeeder::class,
            ShopAttributeGroupTableSeeder::class,
            ShopBannerTypeTableSeeder::class,
            ShopBrandTableSeeder::class,
            ShopSupplierTableSeeder::class,
            ShopLengthClassTableSeeder::class,
            ShopWeightClassTableSeeder::class,
            ShopOrderStatusTableSeeder::class,
            ShopPaymentStatusTableSeeder::class,
            ShopShippingStatusTableSeeder::class,
            ShopTaxTableSeeder::class,
        ]);
    }
}
