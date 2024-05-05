<?php

namespace App\Rules;

use App\Constants\QuestionConstants;
use App\Models\ChoiceQuestion;
use App\Models\ChoiceQuestionAnswer;
use Illuminate\Contracts\Validation\Rule;

class ChoiceQuestionAnswerExistsRule implements Rule
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
        $ids = explode(',', $value);
        $isPassed = true;
        if (ChoiceQuestion::find($key)->type == QuestionConstants::SINGLE_ANSWER_TYPE && count($ids) > 1) {
            $isPassed = false;
        }
        foreach ($ids as $id) {
            if (ChoiceQuestionAnswer::whereChoiceQuestionId($key)->whereId($id)->doesntExist()) {
                $isPassed = false;
            }
        }
        return $isPassed;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'There is no such answer to the question or trying to select multiple answers in a single-answer question.';
    }
}
