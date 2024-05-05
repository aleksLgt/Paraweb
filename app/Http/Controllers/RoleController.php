<?php

namespace App\Http\Controllers;

use App\Http\Interfaces\RoleInterface;
use App\Http\Requests\AddPermissionsRequest;
use App\Models\Role;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Throwable;

class RoleController extends Controller
{
    protected RoleInterface $service;
    public function __construct(RoleInterface $service)
    {
        $this->service = $service;
    }

    public function getAll(): JsonResponse
    {
        $data = $this->service->getAll();
        return response()->json($data);
    }

    /**
     * @throws Throwable
     */
    public function addPermissions(AddPermissionsRequest $request, Role $role): JsonResponse
    {
        $requestData    =   $request->validated();
        $this->service->addPermissions($requestData, $role->id);
        return response()->json('', Response::HTTP_CREATED);
    }
}
