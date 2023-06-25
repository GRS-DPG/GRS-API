<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
           MenuSeeder::class,
            ActionSeeder::class,
            EmployeeSeeder::class,
            EntityTypeOrganogramSeeder::class,
            EntityOrganogramSeeder::class,
            EntityTypeRoleSeeder::class,
            EntityTypeSeeder::class,
            UserSeeder::class,
            MenuActionRoleSeeder::class,
            EntityTrainingTargetSeeder::class

        ]);
    }
}
