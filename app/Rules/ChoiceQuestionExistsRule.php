<?php

namespace App\Rules;

use App\Models\ChoiceQuestion;
use Illuminate\Contracts\Validation\Rule;

class ChoiceQuestionExistsRule implements Rule
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
    public function passes($attribute, $value)
    {
        $key = explode('.', $attribute)[1];
        return ChoiceQuestion::whereId($key)->whereIsVisible(true)->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The question is hidden or does not exist';
    }
}
