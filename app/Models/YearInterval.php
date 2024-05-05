<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\YearInterval
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|YearInterval newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|YearInterval newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|YearInterval query()
 * @method static \Illuminate\Database\Eloquent\Builder|YearInterval whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|YearInterval whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|YearInterval whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|YearInterval whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class YearInterval extends Model
{
    use HasFactory;

    protected $fillable =   [
        'name'
    ];
}
