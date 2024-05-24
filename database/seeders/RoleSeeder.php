<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Admin',
                'description' => 'Quản trị viên'
            ],
            [
                'name' => 'User',
                'description' => 'Người dùng'
            ]
        ];

        DB::table('roles')->insert($roles);
    }
}
