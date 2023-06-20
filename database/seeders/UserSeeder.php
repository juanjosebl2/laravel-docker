<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '12345678',
                'role' => 'admin',
            ],
            [
                'name' => 'juan',
                'email' => 'juan@gmail.com',
                'password' => '12345678',
                'role' => 'standard',
            ]
        ];

        foreach ($users as $user) {
            $created_user = User::create([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => $user['password'],
            ]);

            $created_user->assignRole($user['role']);
        }
    }
}
