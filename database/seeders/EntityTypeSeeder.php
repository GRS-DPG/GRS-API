<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entity_types')->insert([
            [
                'name'=>'Association',
                'entity_type_level'=>0,
                'description'=>'Association Type',
                'created_by'=>'sadek'

            ]
        ]);
    }
}
