<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopAttributeGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_attribute_groups')->insert([
            [
                'id' => 1,
                'name' => 'Color',
                'status' => 1,
                'sort' => 1,
                'type' => 'radio',
                'created_by' => 1, // id of system admin
                'updated_by' => 1, // id of system admin
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'id' => 2,
                'name' => 'Size',
                'status' => 1,
                'sort' => 2,
                'type' => 'radio',
                'created_by' => 1, // id of system admin
                'updated_by' => 1, // id of system admin
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]
        ]);
    }
}
