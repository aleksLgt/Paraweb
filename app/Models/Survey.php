<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Support\Carbon;

/**
 * App\Models\Survey
 *
 * @property int $id
 * @property string $name
 * @property int $survey_category_id
 * @property int $survey_admin_id
 * @property int $year_interval_id
 * @property string $planned_date_start
 * @property string $planned_date_end
 * @property string|null $real_date_start
 * @property string|null $real_date_end
 * @property bool $is_active
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|\App\Models\ChoiceQuestion[] $choice_questions
 * @property-read int|null $choice_questions_count
 * @property-read Collection|\App\Models\FreeQuestion[] $free_questions
 * @property-read int|null $free_questions_count
 * @property-read Collection|\App\Models\PointQuestion[] $point_questions
 * @property-read int|null $point_questions_count
 * @property-read \App\Models\User $survey_admin
 * @property-read \App\Models\SurveyCategory $survey_category
 * @property-read Collection|\App\Models\User[] $survey_operators
 * @property-read int|null $survey_operators_count
 * @method static Builder|Survey newModelQuery()
 * @method static Builder|Survey newQuery()
 * @method static Builder|Survey query()
 * @method static Builder|Survey whereCreatedAt($value)
 * @method static Builder|Survey whereId($value)
 * @method static Builder|Survey whereIsActive($value)
 * @method static Builder|Survey whereName($value)
 * @method static Builder|Survey wherePlannedDateEnd($value)
 * @method static Builder|Survey wherePlannedDateStart($value)
 * @method static Builder|Survey whereRealDateEnd($value)
 * @method static Builder|Survey whereRealDateStart($value)
 * @method static Builder|Survey whereSurveyAdminId($value)
 * @method static Builder|Survey whereSurveyCategoryId($value)
 * @method static Builder|Survey whereUpdatedAt($value)
 * @method static Builder|Survey whereYearIntervalId($value)
 * @mixin Eloquent
 * @property bool $is_visible
 * @method static Builder|Survey whereIsVisible($value)
 */
class Survey extends Model
{
    use HasFactory;

    protected $fillable =   [
        'name',
        'survey_admin_id',
        'year_interval_id',
        'planned_date_start',
        'planned_date_end',
        'survey_category_id',
        'real_date_start',
        'real_date_end',
        'is_active',
        'is_visible'
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];

    public function survey_category(): BelongsTo
    {
        return $this->belongsTo(SurveyCategory::class);
    }


    public function survey_operators(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'survey_operators', 'survey_id', 'operator_id');
    }

    public function survey_admin(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function point_questions(): HasMany
    {
        return $this->hasMany(PointQuestion::class);
    }

    public function free_questions(): HasMany
    {
        return $this->hasMany(FreeQuestion::class);
    }

    public function choice_questions(): HasMany
    {
        return $this->hasMany(ChoiceQuestion::class);
    }

    public function free_question_user_answers(): HasManyThrough
    {
        return $this->hasManyThrough(FreeQuestionUserAnswer::class, FreeQuestion::class);
    }

    public function point_question_user_answers(): HasManyThrough
    {
        return $this->hasManyThrough(PointQuestionUserAnswer::class, PointQuestion::class);
    }

    public function choice_question_user_answers(): HasManyThrough
    {
        return $this->hasManyThrough(ChoiceQuestionUserAnswer::class, ChoiceQuestion::class);
    }

    public function countUserAnswers(): int
    {
        $countFreeQuestionUserAnswers = $this->free_question_user_answers()->count();
        $countPointQuestionUserAnswers = $this->point_question_user_answers()->count();
        $countChoiceQuestionUserAnswers = $this->choice_question_user_answers()->count();
        return $countFreeQuestionUserAnswers + $countPointQuestionUserAnswers + $countChoiceQuestionUserAnswers;
    }

    public function countQuestionsRequiringAnswer(): int
    {
        $countFreeQuestions = $this->free_questions()->whereIsAnswerRequired(true)->count();
        $countPointQuestions = $this->point_questions()->whereIsAnswerRequired(true)->count();
        $countChoiceQuestions = $this->choice_questions()->whereIsAnswerRequired(true)->count();
        return $countFreeQuestions + $countPointQuestions + $countChoiceQuestions;
    }
}
