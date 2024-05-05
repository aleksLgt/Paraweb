<?php

namespace App\Http\Controllers;

use App\Http\Requests\AnswerQuestionsRequest;
use App\Http\Requests\SurveyCreateRequest;
use App\Http\Requests\SurveysGetRequest;
use App\Http\Requests\SurveyUpdateRequest;
use App\Models\Survey;
use App\Services\SurveyService;
use Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class SurveyController extends Controller
{
    protected SurveyService $service;
    public function __construct(SurveyService $service)
    {
        $this->service = $service;
    }

    public function getAll(SurveysGetRequest $request): JsonResponse
    {
        $categoryId = $request->survey_category_id;
        $data = $this->service->getAll($categoryId);
        return response()->json($data);
    }

    public function getMeAll(SurveysGetRequest $request): JsonResponse
    {
        $categoryId = $request->survey_category_id;
        $userId = auth()->user()->id;
        $data = $this->service->getAll($categoryId, $userId);
        return response()->json($data);
    }

    public function get(Survey $survey): JsonResponse
    {
        $data = $this->service->get($survey);
        return response()->json($data);
    }

    /**
     * @throws Throwable
     */
    public function create(SurveyCreateRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $this->service->create($requestData);
        return response()->json('', Response::HTTP_CREATED);
    }

    /**
     * @throws Throwable
     */
    public function update(SurveyUpdateRequest $request, Survey $survey): JsonResponse
    {
        Gate::authorize('can-update-survey', $survey);
        $requestData = $request->validated();
        $this->service->update($requestData, $survey->id);
        return response()->json();
    }

    public function active(Survey $survey): JsonResponse
    {
        $data = $this->service->active($survey->id);
        return response()->json($data);
    }

    public function inactive(Survey $survey): JsonResponse
    {
        $data = $this->service->inactive($survey->id);
        return response()->json($data);
    }

    public function hide(Survey $survey): JsonResponse
    {
        $data = $this->service->hide($survey->id);
        return response()->json($data);
    }

    public function visible(Survey $survey): JsonResponse
    {
        $data = $this->service->visible($survey->id);
        return response()->json($data);
    }

    public function getQuestions(Survey $survey): JsonResponse
    {
        $data = $this->service->getQuestions($survey->id);
        return response()->json($data);
    }

    public function getPublicQuestions(Survey $survey): JsonResponse
    {
        if (!$survey->is_active || !$survey->is_visible) {
            return response()->json('The survey is hidden or no longer active.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $data = $this->service->getPublicQuestions($survey->id);
        return response()->json($data);
    }

    /**
     * @throws Throwable
     */
    public function answerQuestions(AnswerQuestionsRequest $request, Survey $survey): JsonResponse
    {
        if (!$survey->is_active || !$survey->is_visible) {
            return response()->json('The survey is hidden or no longer active.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $requestData = $request->validated();
        $data = $this->service->answerQuestions($requestData, $survey);
        if (!$data) {
            return response()->json('Not all necessary questions have answers.', Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        return response()->json($data, Response::HTTP_CREATED);
    }

    public function getStatisticsBySurvey(Survey $survey)
    {
        $data = $this->service->getStatisticsBySurvey($survey);
        return response()->json($data);
    }
}
