<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Division
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Division newModelQuery()
 * @method static Builder|Division newQuery()
 * @method static Builder|Division query()
 * @method static Builder|Division whereCreatedAt($value)
 * @method static Builder|Division whereId($value)
 * @method static Builder|Division whereName($value)
 * @method static Builder|Division whereUpdatedAt($value)
 * @mixin Eloquent
 * @property int $discipline_id
 * @method static Builder|Division whereDisciplineId($value)
 */
class Division extends Model
{
    use HasFactory;

    protected $fillable =   [
        'name',
        'discipline_id'
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];
}
