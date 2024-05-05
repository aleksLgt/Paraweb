<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\FreeQuestionUserAnswer
 *
 * @property int $id
 * @property int $free_question_id
 * @property string $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FreeQuestionUserAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FreeQuestionUserAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FreeQuestionUserAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|FreeQuestionUserAnswer whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreeQuestionUserAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreeQuestionUserAnswer whereFreeQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreeQuestionUserAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FreeQuestionUserAnswer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class FreeQuestionUserAnswer extends Model
{
    use HasFactory;

    protected $fillable =   [
        'answer'
    ];

    protected $hidden = [
        'laravel_through_key'
    ];
}
