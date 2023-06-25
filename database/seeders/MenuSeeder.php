<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'menu_name_en'=>'association dashboard',
                'link'=>'/dash-association',
                'icon'=>'bi-dashboard',
                'type'=>'main'
            ],
            [
                'menu_name_en'=>'Institution dashboard',
                'link'=>'/dash-institution',
                'icon'=>'bi-dashboard',
                'type'=>'main'
            ],
            [
                'menu_name_en'=>'User dashboard',
                'link'=>'/dash-user',
                'icon'=>'bi-dashboard',
                'type'=>'main'
            ]
        ]);

    }
}
