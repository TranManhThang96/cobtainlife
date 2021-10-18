<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopShippingStatusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_shipping_status')->insert([
            [
                'id' => 1,
                'name' => 'Not sent',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'id' => 2,
                'name' => 'Sending',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'id' => 3,
                'name' => 'Shipping done',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]
        ]);
    }
}
