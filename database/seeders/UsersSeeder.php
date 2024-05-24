<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'User 1',
                'email' => 'user1@example.com',
                'password' => Hash::make('secret'),
                'trang_thai' => 1
            ],
            [
                'name' => 'User 2',
                'email' => 'user2@example.com',
                'password' => Hash::make('secret'),
                'trang_thai' => 1
            ],
            [
                'name' => 'User 3',
                'email' => 'user3@example.com',
                'password' => Hash::make('secret'),
                'trang_thai' => 1
            ],
            [
                'name' => 'User 4',
                'email' => 'user4@example.com',
                'password' => Hash::make('secret'),
                'trang_thai' => 1
            ],
            [
                'name' => 'User 5',
                'email' => 'user5@example.com',
                'password' => Hash::make('secret'),
                'trang_thai' => 1
            ],
        ];

        foreach ($users as $user) {
            \App\Models\User::create($user);
        }
    }
}
