<?php

namespace App\Http\Requests;

use App\Constants\QuestionConstants;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ChoiceQuestionCreateRequest extends FormRequest
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
            'answers'    =>  [
                'array',
                'required',
            ],
            'answers.*'  =>  [
                'string',
                'distinct'
            ],
            'is_answer_required'    =>  [
                'boolean'
            ],
            'type'  =>  [
                'required',
                'integer',
                Rule::in(QuestionConstants::QUESTION_TYPES)
            ],
            'survey_id' =>  [
                'required',
                'integer',
                'exists:surveys,id'
            ]
        ];
    }
}
