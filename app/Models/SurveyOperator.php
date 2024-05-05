<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\SurveyOperator
 *
 * @property int $id
 * @property int $operator_id
 * @property int $survey_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|SurveyOperator newModelQuery()
 * @method static Builder|SurveyOperator newQuery()
 * @method static Builder|SurveyOperator query()
 * @method static Builder|SurveyOperator whereCreatedAt($value)
 * @method static Builder|SurveyOperator whereId($value)
 * @method static Builder|SurveyOperator whereOperatorId($value)
 * @method static Builder|SurveyOperator whereSurveyId($value)
 * @method static Builder|SurveyOperator whereUpdatedAt($value)
 * @mixin Eloquent
 */
class SurveyOperator extends Model
{
    use HasFactory;

    protected $fillable =   [
        'operator_id',
        'survey_id',
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];
}
