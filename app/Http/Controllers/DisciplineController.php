<?php

namespace App\Http\Controllers;

use App\Http\Requests\AttachDivisionRequest;
use App\Http\Requests\DetachDivisionRequest;
use App\Http\Requests\DisciplineCreateRequest;
use App\Models\Discipline;
use App\Services\DisciplineService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class DisciplineController extends Controller
{
    protected DisciplineService $service;
    public function __construct(DisciplineService $service)
    {
        $this->service = $service;
    }

    public function create(DisciplineCreateRequest $request): JsonResponse
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

    public function attach(AttachDivisionRequest $request, Discipline $discipline): JsonResponse
    {
        $data = $this->service->attach($discipline->id, $request->division_id);
        return response()->json($data, Response::HTTP_CREATED);
    }

    public function detach(DetachDivisionRequest $request, Discipline $discipline): JsonResponse
    {
        $data = $this->service->detach($discipline->id, $request->division_id);
        return response()->json($data);
    }

    public function detachAll(Discipline $discipline): JsonResponse
    {
        $data = $this->service->detachAll($discipline->id);
        return response()->json($data);
    }
}
