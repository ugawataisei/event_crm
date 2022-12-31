<?php

namespace Database\Seeders;

use App\Consts\UserConst;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'email' => 'admin@admin.admin',
                'password' => Hash::make('password'),
                'role' => UserConst::ADMIN_ROLE,
            ],
            [
                'name' => 'manager',
                'email' => 'manager@manager.manager',
                'password' => Hash::make('password'),
                'role' => UserConst::MANAGER_ROLE_LOWER,
            ],
            [
                'name' => 'user',
                'email' => 'user@user.user',
                'password' => Hash::make('password'),
                'role' => UserConst::USER_ROLE_LOWER,
            ],
        ]);
    }
}
