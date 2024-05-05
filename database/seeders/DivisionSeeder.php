<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Seeder;

class DivisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Division::firstOrCreate([
            'name'          =>  'Кафедра акушерства и гинекологии',
        ]);

        Division::firstOrCreate([
            'name'  =>  'Кафедра дерматовенерологии и косметологии',
        ]);
    }
}
