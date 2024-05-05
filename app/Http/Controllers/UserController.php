<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Throwable;
use Validator;

class UserController extends Controller
{
    protected UserService $service;
    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function getAll(): JsonResponse
    {
        $data = $this->service->getAll();
        return response()->json($data);
    }

    public function getSurveyAdmins(): JsonResponse
    {
        $data = $this->service->getSurveyAdmins();
        return response()->json($data);
    }

    public function getSurveyOperators(): JsonResponse
    {
        $data = $this->service->getSurveyOperators();
        return response()->json($data);
    }

    /**
     * @throws Throwable
     */
    public function create(UserCreateRequest $request): JsonResponse
    {
        $requestData = $request->validated();
        $this->service->create($requestData);
        return response()->json('', Response::HTTP_CREATED);
    }

    /**
     * @throws Throwable
     */
    public function update(UserUpdateRequest $request, User $user): JsonResponse
    {
        $requestData = $request->validated();
        $this->service->update($requestData, $user->id);
        return response()->json();
    }
}
