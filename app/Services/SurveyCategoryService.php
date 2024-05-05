<?php

namespace App\Services;

use App\Models\SurveyCategory;
use Illuminate\Database\Eloquent\Model;

class SurveyCategoryService
{
    public function create(mixed $requestData): Model|SurveyCategory
    {
        return SurveyCategory::create($requestData);
    }

    public function getAll(): array
    {
        return SurveyCategory::get()->toArray();
    }
}
