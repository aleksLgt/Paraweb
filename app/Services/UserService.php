<?php

namespace App\Services;

use App\Constants\RoleConstants;
use App\Models\User;
use App\Models\UserRole;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class UserService
{
    public function getAll()
    {
       return User::select(['id', 'name', 'created_at', 'updated_at'])
           ->with('roles')
           ->get()
           ->toArray();
    }

    /**
     * @throws Throwable
     */
    public function create(mixed $requestData): void
    {
        $requestData['password'] = bcrypt($requestData['password']);
        DB::transaction(function () use ($requestData) {
            $user = User::create($requestData);
            foreach ($requestData['roles'] as $roleId) {
                $user->roles()->attach($roleId);
            }
        });

    }

    /**
     * @throws Throwable
     */
    public function update(mixed $requestData, $userId): void
    {
        if (isset($requestData['password'])) {
            $requestData['password'] = bcrypt($requestData['password']);
        }
        DB::transaction(function () use ($requestData, $userId) {
            User::find($userId)->update($requestData);
            UserRole::whereUserId($userId)->delete();
            if (isset($requestData['roles'])) {
                foreach ($requestData['roles'] as $roleId) {
                    User::find($userId)->roles()->attach($roleId);
                }
            }
        });
    }

    public function getSurveyAdmins()
    {
        return User::select(['id', 'name', 'created_at', 'updated_at'])
            ->whereRelation('roles', 'roles.id', '=', RoleConstants::SURVEY_ADMIN)
            ->get()
            ->toArray();
    }

    public function getSurveyOperators()
    {
        return User::select(['id', 'name', 'created_at', 'updated_at'])
            ->whereRelation('roles', 'roles.id', '=', RoleConstants::SURVEY_OPERATOR)
            ->get()
            ->toArray();
    }
}
