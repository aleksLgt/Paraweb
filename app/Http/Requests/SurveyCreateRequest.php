<?php

namespace App\Http\Requests;

use App\Rules\IsSurveyAdminRule;
use App\Rules\IsSurveyOperatorRule;
use Carbon\Carbon;
use Exception;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;
use Request;
use Validator;

class SurveyCreateRequest extends FormRequest
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
            'name'  =>  [
                'required',
                'string'
            ],
            'year_interval_id' =>  [
                'required',
                'integer',
                'exists:year_intervals,id'
            ],
            'survey_category_id'    =>  [
                'required',
                'integer',
                'exists:survey_categories,id'
            ],
            'planned_date_start' =>  [
                'required',
                'string',
                'date_format:d.m.Y'
            ],
            'planned_date_end' =>  [
                'required',
                'string',
                'date_format:d.m.Y'
            ],
            'survey_admin_id'  =>  [
                'required',
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
            // This forces the validator to evaluate the rules defined in the rules() method above.
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
