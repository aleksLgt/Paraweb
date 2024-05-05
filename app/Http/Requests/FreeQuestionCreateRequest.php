<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FreeQuestionCreateRequest extends FormRequest
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
            'text'  =>  [
                'required',
                'string'
            ],
            'is_answer_required'    =>  [
                'boolean',
            ],
            'survey_id' =>  [
                'required',
                'integer',
                'exists:surveys,id'
            ]
        ];
    }
}
