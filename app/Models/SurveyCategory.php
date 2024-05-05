<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\SurveyCategory
 *
 * @property int $id
 * @property string $name
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|SurveyCategory newModelQuery()
 * @method static Builder|SurveyCategory newQuery()
 * @method static Builder|SurveyCategory query()
 * @method static Builder|SurveyCategory whereCreatedAt($value)
 * @method static Builder|SurveyCategory whereId($value)
 * @method static Builder|SurveyCategory whereName($value)
 * @method static Builder|SurveyCategory whereUpdatedAt($value)
 * @mixin Eloquent
 */
class SurveyCategory extends Model
{
    use HasFactory;

    protected $fillable =   [
        'name'
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];
}
