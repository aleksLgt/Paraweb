<?php

namespace Database\Seeders;

use App\Constants\RoleConstants;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Логин admin, пароль Admin123
        $user = User::firstOrCreate([
            'login'     =>  'admin',
            'name'      =>  'Администратор',
            'password'  =>  '$2y$10$MD0kwUbciU7UP1rExhIj5O4q.660dIe/5ATIPCMxaZw7b5l8h.dHO',
            'email'     =>  'admin@email.com',
        ]);

        UserRole::firstOrCreate([
            'user_id'   =>  $user->id,
            'role_id'   =>  RoleConstants::SURVEY_ADMIN
        ]);

        UserRole::firstOrCreate([
            'user_id'   =>  $user->id,
            'role_id'   =>  RoleConstants::SYSTEM_ADMIN
        ]);

        UserRole::firstOrCreate([
            'user_id'   =>  $user->id,
            'role_id'   =>  RoleConstants::SURVEY_OPERATOR
        ]);
    }
}
