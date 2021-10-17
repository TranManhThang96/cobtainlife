<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopLengthClassTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_length_class')->insert([
            [
                'id' => 1,
                'name' => 'in',
                'description' => 'Inch',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'id' => 2,
                'name' => 'm',
                'description' => 'Meter',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'id' => 3,
                'name' => 'cm',
                'description' => 'Centimeter',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'id' => 4,
                'name' => 'mm',
                'description' => 'Millimeter',
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
        ]);
    }
}
