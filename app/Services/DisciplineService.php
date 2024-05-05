<?php

namespace App\Services;

use App\Models\Discipline;
use App\Models\DisciplineDivision;
use Illuminate\Database\Eloquent\Model;

class DisciplineService
{
    public function getAll(): array
    {
        return Discipline::with('divisions')
            ->get()
            ->toArray();
    }

    public function create(mixed $requestData): Model|Discipline
    {
        return Discipline::create($requestData);
    }

    public function attach($disciplineId, $divisionId): Model|DisciplineDivision
    {
        return DisciplineDivision::firstOrCreate([
            'discipline_id' =>  $disciplineId,
            'division_id'   =>  $divisionId
        ]);
    }

    public function detach($disciplineId, $divisionId)
    {
        if (DisciplineDivision::whereDisciplineId($disciplineId)->count() == 1) {
            return response()->json('Нельзя удалить единственную подкатегорию в дисциплине');
        }

        return DisciplineDivision::whereDisciplineId($disciplineId)
            ->whereDivisionId($divisionId)
            ->delete();
    }

    public function detachAll($disciplineId)
    {
        return DisciplineDivision::whereDisciplineId($disciplineId)
            ->delete();
    }
}
