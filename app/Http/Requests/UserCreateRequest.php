<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserCreateRequest extends FormRequest
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
                'required',
                'string',
                'unique:users,login'
            ],
            'name' =>  [
                'required',
                'string',
            ],
            'email' =>  [
                'required',
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
                'required',
                'string'
            ]
        ];
    }
}
