<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate([
            'name'  =>  'Администратор системы'
        ]);

        Role::firstOrCreate([
            'name'  =>  'Администратор опроса'
        ]);

        Role::firstOrCreate([
            'name'  =>  'Оператор опроса'
        ]);
    }
}
