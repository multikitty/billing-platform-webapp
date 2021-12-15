<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Constants\PermissionAndRoleConstant;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $isLocalMachine = env('APP_ENV') == "local";

        if (!User::where('email', "=", 'quan.dev@outlook.com')->first()) {
            $user = User::firstOrCreate(
                [
                    'name' => 'Quan Jinsong',
                    'email' => 'quan.dev@outlook.com',
                    'password' => Hash::make(($isLocalMachine) ? 'quan.dev@outlook.com' : 'nFjnXJ5e356N'),
                ]
            );

            $user->assignRole(PermissionAndRoleConstant::ROLE_ADMIN);
        }
    }
}
