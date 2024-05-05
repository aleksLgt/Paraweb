<?php

namespace App\Services;

use App\Models\FreeQuestion;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class FreeQuestionService
{
    public function create($requestData): Model|FreeQuestion
    {
        return FreeQuestion::create($requestData);
    }

    public function update($requestData, $questionId): bool|int
    {
        return FreeQuestion::whereId($questionId)->update($requestData);
    }

    public function delete($questionId): int
    {
        return FreeQuestion::destroy($questionId);
    }

    public function hide($questionId): bool|int
    {
        return FreeQuestion::whereId($questionId)->update(['is_visible' =>  false]);
    }

    public function visible($questionId): bool|int
    {
        return FreeQuestion::whereId($questionId)->update(['is_visible' =>  true]);
    }

    public function get($questionId): Model|Collection|array|FreeQuestion|null
    {
        return FreeQuestion::find($questionId);
    }
}
