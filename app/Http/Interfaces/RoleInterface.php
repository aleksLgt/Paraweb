<?php

namespace App\Http\Interfaces;

interface RoleInterface
{
    public function addPermissions($requestData, int $id);
    public function getAll();
}
