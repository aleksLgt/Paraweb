<?php

namespace Database\Seeders;

use App\Models\Discipline;
use Illuminate\Database\Seeder;

class DisciplineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Discipline::firstOrCreate([
            'name'  =>  'Акушерство'
        ]);

        Discipline::firstOrCreate([
            'name'  =>  'Дерматовенерология'
        ]);
    }
}
