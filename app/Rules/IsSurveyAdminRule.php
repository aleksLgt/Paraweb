<?php

namespace App\Rules;

use App\Constants\RoleConstants;
use App\Models\User;
use Illuminate\Contracts\Validation\Rule;

class IsSurveyAdminRule implements Rule
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
        return User::whereId($value)
            ->whereRelation('roles', 'roles.id', '=', RoleConstants::SURVEY_ADMIN)
            ->exists();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'The admin with this id is not the survey administrator.';
    }
}
