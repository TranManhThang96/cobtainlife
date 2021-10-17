<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ShopSupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shop_suppliers')->insert([
            [
                'id' => 1,
                'name' => 'NCC1',
                'alias' => 'ncc1',
                'email' => 'ncc1@gmail.com',
                'phone' => '0396366421',
                'address' => '',
                'url' => '',
                'status' => 1,
                'sort' => 1,
                'created_by' => 1, // id of system admin
                'updated_by' => 1, // id of system admin
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
            [
                'id' => 2,
                'name' => 'NCC2',
                'alias' => 'ncc2',
                'email' => 'ncc2@gmail.com',
                'phone' => '0396366422',
                'address' => '',
                'url' => '',
                'status' => 1,
                'sort' => 1,
                'created_by' => 1, // id of system admin
                'updated_by' => 1, // id of system admin
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ],
        ]);
    }
}
