<?php

namespace Database\Seeders;

use App\Models\DisciplineDivision;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DisciplineDivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DisciplineDivision::firstOrCreate([
            'discipline_id' =>  1,
            'division_id'   =>  1
        ]);

        DisciplineDivision::firstOrCreate([
            'discipline_id' =>  2,
            'division_id'   =>  2
        ]);
    }
}
