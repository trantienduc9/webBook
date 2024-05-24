<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = [
            [
                'name' => 'Tiểu thuyết',
                'ghichu' => 'Sách hay'
            ],
            [
                'name' => 'Truyện ngắn',
                'ghichu' => 'Sách hay'
            ],
            [
                'name' => 'Huyền bí',
                'ghichu' => 'Sách hay'
            ],
            [
                'name' => 'kinh điển',
                'ghichu' => 'Sách hay'
            ],
            [
                'name' => 'kiếm hiệp',
                'ghichu' => 'Sách hay'
            ],
            [
                'name' => 'lịch sử',
                'ghichu' => 'Sách hay'
            ],
            [
                'name' => 'Thơ',
                'ghichu' => 'Sách hay'
            ],
            [
                'name' => 'phưu lưu',
                'ghichu' => 'Sách hay'
            ],
            [
                'name' => 'khoa học viển tưởng',
                'ghichu' => 'Sách hay'
            ],
            [
                'name' => 'Khác',
                'ghichu' => 'Sách hay'
            ]
        ];

        DB::table('category')->insert($category);
    }
}
