<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('users')->insert([
            [
                'username'=>'admin',
                'email'=>'admin@demo.com',
                'password'=>Hash::make('123456'),
                'force_change_pass'=>1

            ]
        ]);
    }
}
