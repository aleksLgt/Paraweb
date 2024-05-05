<?php

namespace App\Http\Controllers;

use App\Http\Requests\FreeQuestionCreateRequest;
use App\Http\Requests\FreeQuestionUpdateRequest;
use App\Models\FreeQuestion;
use App\Services\FreeQuestionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class FreeQuestionController extends Controller
{
    protected FreeQuestionService $service;
    public function __construct(FreeQuestionService $service)
    {
        $this->service = $service;
    }

    public function create(FreeQuestionCreateRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $data = $this->service->create($requestData);
        return response()->json($data, Response::HTTP_CREATED);
    }

    public function update(FreeQuestionUpdateRequest $request, FreeQuestion $question): JsonResponse
    {
        $requestData = $request->validated();
        $data = $this->service->update($requestData, $question->id);
        return response()->json($data);
    }

    public function delete(FreeQuestion $question): JsonResponse
    {
        $data = $this->service->delete($question->id);
        return response()->json($data);
    }

    public function hide(FreeQuestion $question): JsonResponse
    {
        $data = $this->service->hide($question->id);
        return response()->json($data);
    }

    public function visible(FreeQuestion $question): JsonResponse
    {
        $data = $this->service->visible($question->id);
        return response()->json($data);
    }

    public function get(FreeQuestion $question)
    {
        $data = $this->service->get($question->id);
        return response()->json($data);
    }
}
