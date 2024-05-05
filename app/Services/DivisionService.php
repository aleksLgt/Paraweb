<?php

namespace App\Services;

use App\Models\Division;
use Illuminate\Database\Eloquent\Model;

class DivisionService
{
    public function getAll(): array
    {
        return Division::get()
            ->toArray();
    }

    public function create(mixed $requestData): Model|Division
    {
        return Division::create($requestData);
    }
}
