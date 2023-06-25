<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EntityTrainingTargetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('entity_training_targets')->insert([
            [
                'entity_info_id'=>1,
                'tranche_id'=>1,
                'target_year_id'=>1,
                'target_year'=>'201-2017',
                'target_trainee_number'=>'5300',
                'active_status'=>1
            ],
            [
                'entity_info_id'=>2,
                'tranche_id'=>1,
                'target_year_id'=>1,
                'target_year'=>'201-2017',
                'target_trainee_number'=>'7000',
                'active_status'=>1
            ],

        ]);
    }
}
