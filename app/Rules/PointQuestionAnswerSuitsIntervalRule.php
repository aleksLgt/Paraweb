<?php

namespace App\Rules;

use App\Models\PointQuestion;
use Illuminate\Contracts\Validation\Rule;

class PointQuestionAnswerSuitsIntervalRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $key = explode('.', $attribute)[1];
        $pointQuestion = PointQuestion::whereId($key)->whereIsVisible(true)->first();
        $minScore = $pointQuestion->min_score;
        $maxScore = $pointQuestion->max_score;
        return $value >= $minScore && $value <= $maxScore;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The value is not included in the interval min_score and max_score';
    }
}
