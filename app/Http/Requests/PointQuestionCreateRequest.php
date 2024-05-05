<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PointQuestionCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
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
            'text'                  =>  [
                'required',
                'string'
            ],
            'min_score'             =>  [
                'required',
                'integer',
                'min:0',
                'lt:max_score'
            ],
            'min_score_description' =>  [
                'required',
                'string'
            ],
            'max_score'             =>  [
                'required',
                'integer',
                'gt:min_score'
            ],
            'max_score_description' =>  [
                'required',
                'string'
            ],
            'is_answer_required'    =>  [
                'boolean'
            ],
            'survey_id' =>  [
                'required',
                'integer',
                'exists:surveys,id'
            ]
        ];
    }
}
