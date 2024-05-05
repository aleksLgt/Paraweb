<?php

namespace App\Http\Controllers;

use App\Http\Requests\SurveyCategoryCreateRequest;
use App\Models\SurveyCategory;
use App\Services\SurveyCategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class SurveyCategoryController extends Controller
{
    protected SurveyCategoryService $service;
    public function __construct(SurveyCategoryService $service)
    {
        $this->service = $service;
    }

    public function create(SurveyCategoryCreateRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $data = $this->service->create($requestData);
        return response()->json($data, Response::HTTP_CREATED);
    }

    public function getAll(): JsonResponse
    {
        $data = $this->service->getAll();
        return response()->json($data);
    }
}
