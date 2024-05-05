<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\PointQuestion
 *
 * @property int $id
 * @property string $text
 * @property int $min_score
 * @property string $min_score_description
 * @property int $max_score
 * @property int $survey_id
 * @property string $max_score_description
 * @property bool $is_answer_required
 * @property bool $is_visible
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|PointQuestion newModelQuery()
 * @method static Builder|PointQuestion newQuery()
 * @method static Builder|PointQuestion query()
 * @method static Builder|PointQuestion whereCreatedAt($value)
 * @method static Builder|PointQuestion whereId($value)
 * @method static Builder|PointQuestion whereIsAnswerRequired($value)
 * @method static Builder|PointQuestion whereIsVisible($value)
 * @method static Builder|PointQuestion whereMaxScore($value)
 * @method static Builder|PointQuestion whereMaxScoreDescription($value)
 * @method static Builder|PointQuestion whereMinScore($value)
 * @method static Builder|PointQuestion whereMinScoreDescription($value)
 * @method static Builder|PointQuestion whereSurveyId($value)
 * @method static Builder|PointQuestion whereText($value)
 * @method static Builder|PointQuestion whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\PointQuestionUserAnswer[] $user_answers
 * @property-read int|null $user_answers_count
 */
class PointQuestion extends Model
{
    use HasFactory;

    protected $fillable =   [
        'text',
        'min_score',
        'min_score_description',
        'max_score',
        'max_score_description',
        'survey_id',
        'is_answer_required',
        'is_visible'
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];

    protected $table    =   'point_questions';

    public function user_answers(): HasMany
    {
        return $this->hasMany(PointQuestionUserAnswer::class, 'point_question_id', 'id');
    }
}
