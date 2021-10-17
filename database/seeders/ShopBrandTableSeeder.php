<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopBrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_brands')->insert([
            [
                'id' => 1,
                'name' => 'ABC distributor',
                'alias' => 'abc-distributor',
                'status' => 1,
                'sort' => 1,
                'created_by' => 1, // id of system admin
                'updated_by' => 1, // id of system admin
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'id' => 2,
                'name' => 'XYZ distributor',
                'alias' => 'xyz-distributor',
                'status' => 1,
                'sort' => 1,
                'created_by' => 1, // id of system admin
                'updated_by' => 1, // id of system admin
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]
        ]);
    }
}
