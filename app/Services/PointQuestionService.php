<?php

namespace App\Services;

use App\Models\PointQuestion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class PointQuestionService
{
    public function create(mixed $requestData): Model|PointQuestion
    {
        return PointQuestion::create($requestData);
    }

    public function update(mixed $requestData, $questionId): bool|int
    {
        return PointQuestion::whereId($questionId)->update($requestData);
    }

    public function delete($questionId): int
    {
        return PointQuestion::destroy($questionId);
    }

    public function hide($questionId): bool|int
    {
        return PointQuestion::whereId($questionId)->update(['is_visible' =>  false]);
    }

    public function visible($questionId): bool|int
    {
        return PointQuestion::whereId($questionId)->update(['is_visible' =>  true]);
    }

    public function get($questionId): Model|Collection|array|PointQuestion|null
    {
        return PointQuestion::find($questionId);
    }
}
