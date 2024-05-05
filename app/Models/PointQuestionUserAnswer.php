<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PointQuestionUserAnswer
 *
 * @property int $id
 * @property int $point_question_id
 * @property int $answer
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PointQuestionUserAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PointQuestionUserAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PointQuestionUserAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|PointQuestionUserAnswer whereAnswer($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PointQuestionUserAnswer whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PointQuestionUserAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PointQuestionUserAnswer wherePointQuestionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PointQuestionUserAnswer whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class PointQuestionUserAnswer extends Model
{
    use HasFactory;

    protected $fillable =   [
        'point_question_id',
        'answer'
    ];

    protected $hidden = [
        'laravel_through_key'
    ];
}
