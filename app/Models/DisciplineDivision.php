<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\DisciplineDivision
 *
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineDivision newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineDivision newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineDivision query()
 * @mixin \Eloquent
 * @property int $id
 * @property int $discipline_id
 * @property int $division_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineDivision whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineDivision whereDisciplineId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineDivision whereDivisionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineDivision whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DisciplineDivision whereUpdatedAt($value)
 */
class DisciplineDivision extends Model
{
    use HasFactory;

    protected $table    =   'discipline_division';

    protected $fillable = [
        'discipline_id',
        'division_id'
    ];
}
