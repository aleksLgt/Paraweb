<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\ChoiceQuestionAnswer
 *
 * @property int $id
 * @property int $choice_question_id
 * @property string $text
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|ChoiceQuestionAnswer newModelQuery()
 * @method static Builder|ChoiceQuestionAnswer newQuery()
 * @method static Builder|ChoiceQuestionAnswer query()
 * @method static Builder|ChoiceQuestionAnswer whereChoiceQuestionId($value)
 * @method static Builder|ChoiceQuestionAnswer whereCreatedAt($value)
 * @method static Builder|ChoiceQuestionAnswer whereId($value)
 * @method static Builder|ChoiceQuestionAnswer whereText($value)
 * @method static Builder|ChoiceQuestionAnswer whereUpdatedAt($value)
 * @mixin Eloquent
 */
class ChoiceQuestionAnswer extends Model
{
    use HasFactory;

    protected $fillable =   [
        'choice_question_id',
        'text'
    ];

    protected $casts = [
        'created_at'        =>  'datetime: Y-m-d H:i:s',
        'updated_at'        =>  'datetime: Y-m-d H:i:s',
    ];

    public function user_answers(): HasMany
    {
        return $this->hasMany(ChoiceQuestionUserAnswer::class);
    }
}
