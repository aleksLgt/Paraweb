<?php

namespace App\Http\Controllers;

use App\Http\Requests\DivisionCreateRequest;
use App\Services\DivisionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DivisionController extends Controller
{
    public function __construct(DivisionService $service)
    {
        $this->service = $service;
    }

    public function create(DivisionCreateRequest $request): JsonResponse
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
