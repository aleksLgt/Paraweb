<?php

namespace App\Console\Commands;

use App\Models\YearInterval;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FillYearIntervalsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'once:fill-year-intervals';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Команда заполняет таблицу year_intervals интервалами дат в формате 2019-2020';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $startYear = Carbon::now()->subYear(42);
        $nowYear = Carbon::now()->year;

        while($startYear->year <= $nowYear) {
            YearInterval::firstOrCreate([
                'name'  =>  $startYear->year . '-' . $startYear->year + 1
            ]);
            $startYear  =   $startYear->addYear(1);
        }

        return Command::SUCCESS;
    }
}
