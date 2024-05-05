<?php

namespace App\Rules;

use App\Models\FreeQuestion;
use Illuminate\Contracts\Validation\Rule;

class FreeQuestionBelongsToSurvey implements Rule
{
    protected int $surveyId;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(int $surveyId)
    {
        $this->surveyId = $surveyId;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $key = explode('.', $attribute)[1];
        $surveyId = FreeQuestion::find($key)->survey_id;
        return $surveyId == $this->surveyId;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'This question does not belong to the survey.';
    }
}
