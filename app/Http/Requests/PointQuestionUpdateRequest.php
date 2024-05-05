<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PointQuestionUpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'text'                  =>  [
                'string'
            ],
            'min_score'             =>  [
                'integer',
                'min:0',
                'lt:max_score'
            ],
            'min_score_description' =>  [
                'string'
            ],
            'max_score'             =>  [
                'integer',
                'gt:max_score'
            ],
            'max_score_description' =>  [
                'string'
            ],
            'is_answer_required'    =>  [
                'boolean'
            ],
            'survey_id' =>  [
                'integer',
                'exists:surveys,id'
            ]
        ];
    }
}
