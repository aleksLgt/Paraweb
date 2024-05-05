<?php

namespace App\Console\Commands;

use App\Models\Survey;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SurveyInactiveSchedule extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'schedule:survey-inactive';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Крон, который проверяет раз в сутки, что опрос окончен и обновляет поле is_active на false';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dateNow = Carbon::now();
        foreach(Survey::get() as $survey) {
            $surveyPlannedDateEnd = Carbon::parse($survey->planned_date_end);
            if ($dateNow->greaterThan($surveyPlannedDateEnd)) {
                $survey->update(['is_active'    =>  false]);
            }
        }
    }
}
