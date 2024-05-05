<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'login' =>  [
                'string',
                'unique:users,login'
            ],
            'name' =>  [
                'string',
            ],
            'email' =>  [
                'string',
                'email',
                'unique:users,email'
            ],
            'roles' =>  [
                'required',
                'array'
            ],
            'roles.*'   =>  [
                'integer',
                'distinct',
                'exists:roles,id'
            ],
            'password'  =>  [
                'string'
            ],
            'is_blocked'    =>  [
                'boolean'
            ]
        ];
    }
}
