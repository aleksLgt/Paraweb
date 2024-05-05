<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChoiceQuestionUserAnswer
 *
 * @property int $id
 * @property int $choice_question_id
 * @property int $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ChoiceQuestionUserAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChoiceQuestionUserAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChoiceQuestionUserAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChoiceQuestionUserAnswer whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChoiceQuestionUserAnswer whereChoiceQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChoiceQuestionUserAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChoiceQuestionUserAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChoiceQuestionUserAnswer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChoiceQuestionUserAnswer extends Model
{
    use HasFactory;

    protected $fillable =   [
        'choice_question_answer_id'
    ];

    protected $hidden = [
        'laravel_through_key'
    ];
}
