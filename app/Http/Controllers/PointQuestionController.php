<?php

namespace App\Http\Controllers;

use App\Http\Requests\PointQuestionCreateRequest;
use App\Http\Requests\PointQuestionUpdateRequest;
use App\Models\PointQuestion;
use App\Services\PointQuestionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class PointQuestionController extends Controller
{
    protected PointQuestionService $service;
    public function __construct(PointQuestionService $service)
    {
        $this->service = $service;
    }

    public function create(PointQuestionCreateRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $data = $this->service->create($requestData);
        return response()->json($data, Response::HTTP_CREATED);
    }

    public function update(PointQuestionUpdateRequest $request, PointQuestion $question): JsonResponse
    {
        $requestData = $request->validated();
        $data = $this->service->update($requestData, $question->id);
        return response()->json($data);
    }

    public function delete(PointQuestion $question): JsonResponse
    {
        $data = $this->service->delete($question->id);
        return response()->json($data);
    }

    public function hide(PointQuestion $question): JsonResponse
    {
        $data = $this->service->hide($question->id);
        return response()->json($data);
    }

    public function visible(PointQuestion $question): JsonResponse
    {
        $data = $this->service->visible($question->id);
        return response()->json($data);
    }

    public function get(PointQuestion $question): JsonResponse
    {
        $data = $this->service->get($question->id);
        return response()->json($data);
    }
}
