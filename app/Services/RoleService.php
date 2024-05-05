<?php

namespace App\Services;

use App\Http\Interfaces\RoleInterface;
use App\Models\Role;
use Illuminate\Support\Facades\DB;
use Throwable;

class RoleService implements RoleInterface
{
    public function getAll(): array
    {
        return Role::get()->toArray();
    }

    /**
     * @throws Throwable
     */
    public function addPermissions(mixed $requestData, $roleId): void
    {
        DB::transaction(function () use ($requestData, $roleId) {
            foreach ($requestData['permissions'] as $permissionId) {
                Role::find($roleId)->permissions()->attach($permissionId);
            }
        });
    }
}
