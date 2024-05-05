<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;

/**
 * App\Models\Discipline
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Discipline newModelQuery()
 * @method static Builder|Discipline newQuery()
 * @method static Builder|Discipline query()
 * @method static Builder|Discipline whereCreatedAt($value)
 * @method static Builder|Discipline whereId($value)
 * @method static Builder|Discipline whereName($value)
 * @method static Builder|Discipline whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Division[] $divisions
 * @property-read int|null $divisions_count
 */
class Discipline extends Model
{
    use HasFactory;

    protected $fillable =   [
        'name',
        'text'
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];

    public function divisions(): HasManyThrough
    {
        return $this->hasManyThrough(Division::class, DisciplineDivision::class, 'discipline_id', 'id', 'id', 'division_id');
    }
}
