<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopBannerTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_banner_type')->insert([
            [
                'id' => 1,
                'code' => 'banner',
                'name' => 'Banner website',
                'created_by' => 1, // id of system admin
                'updated_by' => 1, // id of system admin
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'id' => 2,
                'code' => 'background',
                'name' => 'Background website',
                'created_by' => 1, // id of system admin
                'updated_by' => 1, // id of system admin
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'id' => 3,
                'code' => 'breadcrumb',
                'name' => 'Breadcrumb website',
                'created_by' => 1, // id of system admin
                'updated_by' => 1, // id of system admin
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'id' => 4,
                'code' => 'banner-store',
                'name' => 'Banner store',
                'created_by' => 1, // id of system admin
                'updated_by' => 1, // id of system admin
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'id' => 5,
                'code' => 'other',
                'name' => 'Other',
                'created_by' => 1, // id of system admin
                'updated_by' => 1, // id of system admin
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]
        ]);
    }
}
