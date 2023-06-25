<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuActionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_action_roles')->insert([
            [
                'user_role_id'=>1,
                'menu_id'=>1,
                'action_id'=>1,
                'status'=>1
            ],
            [
                'user_role_id'=>1,
                'menu_id'=>1,
                'action_id'=>2,
                'status'=>1
            ]
        ]);
    }
}
