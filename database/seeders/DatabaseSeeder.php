<?php

namespace Database\Seeders;

use App\Models\DisciplineDivision;
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
            RoleSeeder::class,
            UserSeeder::class,
            RolePermissionSeeder::class,
            SurveyCategorySeeder::class,
            DisciplineSeeder::class,
            DivisionSeeder::class,
            DisciplineDivisionSeeder::class
        ]);
    }
}
