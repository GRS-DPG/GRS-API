<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntityTypeOrganogramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entity_type_organograms')->insert([
            [
                'entity_type_role_id'=>1,
                'entity_type_id'=>1,
                'designation_name'=>'developer',
                'order'=>1,
                'status'=>1

            ]
        ]);
    }
}
