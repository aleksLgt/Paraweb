<?php

namespace Database\Seeders;

use App\Models\SurveyCategory;
use Illuminate\Database\Seeder;

class SurveyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SurveyCategory::firstOrCreate([
            'name'  =>  'Качество образования'
        ]);

        SurveyCategory::firstOrCreate([
            'name'  =>  'Другие опросы'
        ]);
    }
}
