<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserManagersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_managers')->insert([
            [
                'id' => 1,
                'name' => 'System Admin',
                'email' => 'system@gmail.com',
                'role' => 1, // system admin
                'password' => Hash::make('system@123123'),
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime(),
            ]
        ]);
    }
}
