<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChoiceQuestionCreateRequest;
use App\Http\Requests\ChoiceQuestionUpdateRequest;
use App\Models\ChoiceQuestionAnswer;
use App\Models\ChoiceQuestion;
use App\Services\ChoiceQuestionService;
use DB;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class ChoiceQuestionController extends Controller
{
    protected ChoiceQuestionService $service;
    public function __construct(ChoiceQuestionService $service)
    {
        $this->service = $service;
    }

    /**
     * @throws Throwable
     */
    public function create(ChoiceQuestionCreateRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $this->service->create($requestData);
        return response()->json('', Response::HTTP_CREATED);
    }

    /**
     * @throws Throwable
     */
    public function update(ChoiceQuestionUpdateRequest $request, ChoiceQuestion $question): JsonResponse
    {
        $requestData = $request->validated();
        $this->service->update($requestData, $question->id);
        return response()->json();
    }

    public function delete(ChoiceQuestion $question): JsonResponse
    {
        $data = $this->service->delete($question->id);
        return response()->json($data);
    }

    public function hide(ChoiceQuestion $question): JsonResponse
    {
        $data = $this->service->hide($question->id);
        return response()->json($data);
    }

    public function visible(ChoiceQuestion $question): JsonResponse
    {
        $data = $this->service->visible($question->id);
        return response()->json($data);
    }

    public function get(ChoiceQuestion $question): JsonResponse
    {
        $data = $this->service->get($question->id);
        return response()->json($data);
    }

    public function getUnselectedAnswersOfQuestion(ChoiceQuestion $question): JsonResponse
    {
        $data = $this->service->getUnselectedAnswersOfQuestion($question->id);
        return response()->json($data);
    }

    /**
     * @throws Exception
     */
    public function deleteQuestionAnswer(ChoiceQuestion $question, ChoiceQuestionAnswer $answer): JsonResponse
    {
        $data = $this->service->deleteQuestionAnswer($question->id, $answer->id);
        return response()->json($data);
    }
}
