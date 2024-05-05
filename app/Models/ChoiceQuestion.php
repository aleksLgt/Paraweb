<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\ChoiceQuestion
 *
 * @property int $id
 * @property string $text
 * @property int $type
 * @property bool $is_answer_required
 * @property int $survey_id
 * @property bool $is_visible
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\App\Models\ChoiceQuestionAnswer[] $answers
 * @property-read int|null $answers_count
 * @method static Builder|ChoiceQuestion newModelQuery()
 * @method static Builder|ChoiceQuestion newQuery()
 * @method static Builder|ChoiceQuestion query()
 * @method static Builder|ChoiceQuestion whereCreatedAt($value)
 * @method static Builder|ChoiceQuestion whereId($value)
 * @method static Builder|ChoiceQuestion whereIsAnswerRequired($value)
 * @method static Builder|ChoiceQuestion whereIsVisible($value)
 * @method static Builder|ChoiceQuestion whereSurveyId($value)
 * @method static Builder|ChoiceQuestion whereText($value)
 * @method static Builder|ChoiceQuestion whereType($value)
 * @method static Builder|ChoiceQuestion whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Collection|\App\Models\ChoiceQuestionUserAnswer[] $user_answers
 * @property-read int|null $user_answers_count
 */
class ChoiceQuestion extends Model
{
    use HasFactory;

    protected $fillable =   [
        'text',
        'type',
        'is_answer_required',
        'survey_id',
        'is_visible',
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];

    public function answers(): HasMany
    {
        return $this->hasMany(ChoiceQuestionAnswer::class);
    }

    public function user_answers(): HasMany
    {
        return $this->hasMany(ChoiceQuestionUserAnswer::class);
    }
}
