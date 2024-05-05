<?php

namespace App\Services;

use App\Constants\RoleConstants;
use App\Models\ChoiceQuestion;
use App\Models\FreeQuestion;
use App\Models\PointQuestion;
use App\Models\Survey;
use Carbon\Carbon;
use DB;
use Exception;
use Throwable;

class SurveyService
{
    public function getAll($categoryId, $userId = null): array
    {
        $isOnlySurveyOperatorRole = false;
        if (count(auth()->user()->roles) == 1 &&
                auth()->user()
                ->whereRelation('roles', 'user_role.role_id', '=', RoleConstants::SURVEY_OPERATOR)
                ->exists()) {
            $isOnlySurveyOperatorRole   =   true;
        }

        return Survey::withAggregate('survey_category', 'name')
            ->withAggregate('survey_admin', 'name')
            ->when(!is_null($categoryId), function ($query) use ($categoryId) {
                $query->where('survey_category_id', $categoryId);
            })->when(!is_null($userId), function ($query) use ($userId) {
                $query->where('survey_admin_id', $userId);
            })->when(($isOnlySurveyOperatorRole), function ($query) {
                $query->where('is_visible', true);
            })->get()
            ->toArray();
    }

    /**
     * @throws Throwable
     */
    public function create(mixed $requestData): void
    {
        DB::transaction(function () use($requestData) {
            $requestData['planned_date_start'] = Carbon::parse($requestData['planned_date_start'])->format('Y-m-d');
            $requestData['planned_date_end'] = Carbon::parse($requestData['planned_date_start'])->format('Y-m-d');

            $survey = Survey::create($requestData);
            foreach ($requestData['survey_operator_ids'] as $id) {
                $survey->survey_operators()->attach($id);
            }
        });
    }

    /**
     * @throws Throwable
     */
    public function update(mixed $requestData, $surveyId): void
    {
        DB::transaction(function () use ($requestData, $surveyId) {
            $survey = Survey::find($surveyId);

            if (isset($requestData['planned_date_start'])) {
                $requestData['planned_date_start'] = Carbon::parse($requestData['planned_date_start'])->format('Y-m-d');
            }

            if (isset($requestData['planned_date_end'])) {
                $requestData['planned_date_end'] = Carbon::parse($requestData['planned_date_start'])->format('Y-m-d');
            }

            $survey->update($requestData);
            $survey->survey_operators()->sync($requestData['survey_operator_ids']);
        });
    }

    public function get(Survey $surveyId): array
    {
        $data = Survey::whereId($surveyId->id)
            ->withAggregate('survey_admin', 'name')
            ->with('survey_operators:users.id,users.name')
            ->get()
            ->toArray();

        $data[0]['countAnswers'] = Survey::find($surveyId->id)->countUserAnswers();
        return $data;
    }

    public function active($surveyId): bool|int
    {
        return Survey::whereId($surveyId)->update(['is_active' =>  true]);
    }

    public function inactive($surveyId): bool|int
    {
        return Survey::whereId($surveyId)->update(['is_active' =>  false]);
    }

    public function getQuestions($surveyId): array
    {
        return Survey::whereId($surveyId)
            ->with('free_questions')
            ->with('choice_questions')
            ->with('point_questions')
            ->get()
            ->toArray();
    }

    public function getPublicQuestions($surveyId): array
    {
        return Survey::whereId($surveyId)
            ->with(['free_questions' =>  function ($query) {
                $query->select([
                    'id',
                    'text',
                    'is_answer_required',
                    'survey_id'
                ])->where('is_visible', true);
            }])
            ->with(['choice_questions' =>  function ($query) {
                $query->select([
                    'id',
                    'text',
                    'type',
                    'is_answer_required',
                    'survey_id'
                ])->with('answers:id,choice_question_id,text')
                    ->where('is_visible', true);
            }])
            ->with(['point_questions' =>  function ($query) {
                $query->select([
                    'id',
                    'text',
                    'min_score',
                    'min_score_description',
                    'max_score',
                    'max_score_description',
                    'is_answer_required',
                    'survey_id'
                ])->where('is_visible', true);
            }])
            ->get()
            ->toArray();
    }

    public function hide($surveyId): bool|int
    {
        return Survey::whereId($surveyId)->update(['is_visible' =>  true]);
    }

    public function visible($surveyId): bool|int
    {
        return Survey::whereId($surveyId)->update(['is_visible' =>  true]);
    }

    /**
     * @throws Exception
     */
    public function answerQuestions($requestData, Survey $survey): bool
    {
        try {
            DB::transaction(function () use ($requestData, $survey) {
                $countQuestionsRequiringAnswer = 0;
                foreach ($requestData['free'] as $freeQuestionId => $freeQuestionAnswer) {
                    if (FreeQuestion::find($freeQuestionId)->is_answer_required) {
                        $countQuestionsRequiringAnswer++;
                    }
                    FreeQuestion::find($freeQuestionId)->user_answers()->create(['answer'  =>  $freeQuestionAnswer]);
                }
                foreach ($requestData['point'] as $pointQuestionId => $pointQuestionAnswer) {
                    if (PointQuestion::find($pointQuestionId)->is_answer_required) {
                        $countQuestionsRequiringAnswer++;
                    }
                    PointQuestion::find($pointQuestionId)->user_answers()->create(['answer'  =>  $pointQuestionAnswer]);
                }

                foreach ($requestData['choice'] as $choiceQuestionId => $choiceQuestionAnswer) {
                    if (ChoiceQuestion::find($choiceQuestionId)->is_answer_required) {
                        $countQuestionsRequiringAnswer++;
                    }
                    $choiceQuestionAnswers = explode(',', $choiceQuestionAnswer);
                    foreach($choiceQuestionAnswers as $answerId) {
                        ChoiceQuestion::find($choiceQuestionId)->user_answers()->create(['choice_question_answer_id' =>  $answerId]);
                    }
                }
                if ($countQuestionsRequiringAnswer != $survey->countQuestionsRequiringAnswer()) {
                    throw new Exception();
                }

                $dateNow = Carbon::now()->format('Y-m-d');
                if (is_null($survey->real_date_start)) {
                    $survey->update(['real_date_start'  =>  $dateNow]);
                }
                $survey->update(['real_date_end'  =>  $dateNow]);
            });
        } catch (Exception) {
            return false;
        } catch (Throwable) {
        }

        return true;
    }

    public function getStatisticsBySurvey(Survey $survey): array
    {
        return Survey::whereId($survey->id)
            ->with(['point_questions' =>  function ($query) {
                $query->select(['id', 'text', 'survey_id'])
                    ->with(['user_answers'    =>  function ($query) {
                        $query->select([
                            'point_question_id',
                            DB::raw('count(id)'),
                            DB::raw('avg(answer)'),
                        ])->groupBy([
                            'point_question_user_answers.point_question_id'
                        ]);
                    }]);
            }])->with(['free_questions' => function ($query) {
                $query->select(['id', 'text', 'survey_id'])
                    ->with(['user_answers'  => function ($query) {
                        $query->select([
                            'free_question_id',
                            'answer'
                        ])->groupBy([
                            'free_question_user_answers.answer',
                            'free_question_user_answers.free_question_id'
                        ]);
                    }]);
            }])->with(['choice_questions' =>  function ($query) {
                $query->select(['id', 'text', 'survey_id'])
                    ->with(['user_answers'    =>  function ($query) {
                        $query->select([
                            'choice_question_user_answers.choice_question_id',
                            'choice_question_answer_id',
                            DB::raw('count(choice_question_user_answers.id)'),
                        ])->join('choice_question_answers', 'choice_question_answers.id', '=', 'choice_question_user_answers.choice_question_answer_id')
                            ->addSelect(['choice_question_answers.text'])
                        ->groupBy([
                            'choice_question_user_answers.choice_question_id',
                            'choice_question_user_answers.choice_question_answer_id',
                            'choice_question_answers.text'
                        ]);
                    }]);
            }])->get()
            ->toArray();
    }
}

