<?php

namespace App\Services;

use App\Http\Interfaces\CommonInterface;
use App\Models\YearInterval;

class CommonService implements CommonInterface
{
    public function getYearIntervals(): array
    {
        return YearInterval::select(['id', 'name'])
            ->get()
            ->toArray();
    }
}
