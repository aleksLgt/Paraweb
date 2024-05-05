<?php

namespace App\Http\Requests;

use App\Rules\ChoiceQuestionAnswerExistsRule;
use App\Rules\ChoiceQuestionBelongsToSurvey;
use App\Rules\ChoiceQuestionExistsRule;
use App\Rules\FreeQuestionBelongsToSurvey;
use App\Rules\FreeQuestionExistsRule;
use App\Rules\PointQuestionAnswerSuitsIntervalRule;
use App\Rules\PointQuestionBelongsToSurvey;
use App\Rules\PointQuestionExistsRule;
use Illuminate\Foundation\Http\FormRequest;

class AnswerQuestionsRequest extends FormRequest
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
        $route = explode('/', $this->fullUrl());
        $idBeforeSurvey = array_search('public', $route);
        $surveyId = $route[$idBeforeSurvey + 1];

        return [
            'free'  =>  [
                'array'
            ],
            'free.*'    =>  [
                'bail',
                'string',
                'distinct',
                new FreeQuestionExistsRule(),
                new FreeQuestionBelongsToSurvey($surveyId)
            ],
            'point'     =>  [
                'array'
            ],
            'point.*'    =>  [
                'bail',
                'integer',
                'distinct',
                'required_with:point.*',
                new PointQuestionExistsRule(),
                new PointQuestionAnswerSuitsIntervalRule(),
                new PointQuestionBelongsToSurvey($surveyId)
            ],
            'choice'    =>  [
                'array'
            ],
            'choice.*'  =>  [
                'bail',
                'string',
                new ChoiceQuestionExistsRule(),
                new ChoiceQuestionAnswerExistsRule(),
                new ChoiceQuestionBelongsToSurvey($surveyId)
            ]
        ];
    }
}
