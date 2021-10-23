<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopTaxTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_tax')->insert([
            [
                'id' => 1,
                'name' => 'No VAT',
                'value' => 0,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'id' => 2,
                'name' => 'Default 10%',
                'value' => 10,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]
        ]);
    }
}
