<?php

namespace Database\Seeders;

use App\Constants\RoleConstants;
use App\Models\Permission;
use App\Models\RolePermission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Permission::get() as $permission) {
            RolePermission::firstOrCreate([
                'role_id'       =>  RoleConstants::SYSTEM_ADMIN,
                'permission_id' =>  $permission->id,
            ]);
        }

        RolePermission::firstOrCreate([
            'role_id'       =>  RoleConstants::SURVEY_ADMIN,
            'permission_id' =>  Permission::whereUri('/surveys')->whereMethod('POST')->first()->id,
        ]);

        RolePermission::firstOrCreate([
            'role_id'       =>  RoleConstants::SURVEY_ADMIN,
            'permission_id' =>  Permission::whereUri('/surveys/{survey}')->whereMethod('PUT')->first()->id,
        ]);

        RolePermission::firstOrCreate([
            'role_id'       =>  RoleConstants::SURVEY_ADMIN,
            'permission_id' =>  Permission::whereUri('/surveys/me')->whereMethod('GET')->first()->id,
        ]);

        RolePermission::firstOrCreate([
            'role_id'       =>  RoleConstants::SURVEY_OPERATOR,
            'permission_id' =>  Permission::whereUri('/surveys/{survey}/active')->whereMethod('PATCH')->first()->id,
        ]);

        RolePermission::firstOrCreate([
            'role_id'       =>  RoleConstants::SURVEY_OPERATOR,
            'permission_id' =>  Permission::whereUri('/surveys/{survey}')->whereMethod('GET')->first()->id,
        ]);
    }
}
