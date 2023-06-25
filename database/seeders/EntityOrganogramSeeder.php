<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class EntityOrganogramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('entity_organograms')->insert([
            [
                'employee_id'=>1,
                'entity_type_org_id'=>1,
                'entity_type_role_id'=>1,
                'assign_date'=>Carbon::create(2021,12,1)
            ]
        ]);
    }
}
