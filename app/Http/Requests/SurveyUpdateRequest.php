<?php

namespace App\Http\Requests;

use App\Rules\IsSurveyAdminRule;
use App\Rules\IsSurveyOperatorRule;
use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;
use Request;
use Validator;

class SurveyUpdateRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name'  =>  [
                'string'
            ],
            'year_interval_id' =>  [
                'integer',
                'exists:year_intervals,id'
            ],
            'survey_category_id'    =>  [
                'integer',
                'exists:survey_categories,id'
            ],
            'planned_date_start' =>  [
                'string',
                'date_format:d.m.Y',
                'required_with:planned_date_end'
            ],
            'planned_date_end' =>  [
                'string',
                'date_format:d.m.Y',
                'required_with:planned_date_start'
            ],
            'survey_admin'  =>  [
                'integer',
                'exists:users,id',
                new IsSurveyAdminRule()
            ],
            'survey_operator_ids'   =>  [
                'required',
                'array',
            ],
            'survey_operator_ids.*' => [
                'integer',
                'distinct',
                new IsSurveyOperatorRule()
            ]
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(/**
         * @throws ValidationException
         */ function ($validator) {
            if ($validator->failed()) return;

            $plannedDateStart = Carbon::parse(Request::get('planned_date_start'))->format('d.m.Y');
            $plannedDateEnd = Carbon::parse(Request::get('planned_date_end'))->format('d.m.Y');
            $dateNow = Carbon::now()->format('d.m.Y');

            Validator::make($this->input(), [
                'planned_date_start' => [
                    'after_or_equal:' . $dateNow,
                    'before_or_equal:' . $plannedDateEnd
                ],
                'date_end' => [
                    'after_or_equal:' . $plannedDateStart,
                    'after_or_equal:' . $plannedDateStart,
                ],
            ])->validate();
        });
    }
}
