<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntityTypeRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entity_type_roles')->insert([
            [
                'entity_type_id'=>1,
                'role_name'=>'developer',
                'role_title'=>'developer',
                'level'=>1

            ]
        ]);
    }
}
