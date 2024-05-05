<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\FreeQuestion
 *
 * @property int $id
 * @property string $text
 * @property bool $is_answer_required
 * @property int $survey_id
 * @property bool $is_visible
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|FreeQuestion newModelQuery()
 * @method static Builder|FreeQuestion newQuery()
 * @method static Builder|FreeQuestion query()
 * @method static Builder|FreeQuestion whereCreatedAt($value)
 * @method static Builder|FreeQuestion whereId($value)
 * @method static Builder|FreeQuestion whereIsAnswerRequired($value)
 * @method static Builder|FreeQuestion whereIsVisible($value)
 * @method static Builder|FreeQuestion whereSurveyId($value)
 * @method static Builder|FreeQuestion whereText($value)
 * @method static Builder|FreeQuestion whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\FreeQuestionUserAnswer[] $user_answers
 * @property-read int|null $user_answers_count
 */
class FreeQuestion extends Model
{
    use HasFactory;

    protected $fillable =   [
        'text',
        'is_answer_required',
        'survey_id',
        'is_visible'
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];

    public function user_answers(): HasMany
    {
        return $this->hasMany(FreeQuestionUserAnswer::class);
    }
}
