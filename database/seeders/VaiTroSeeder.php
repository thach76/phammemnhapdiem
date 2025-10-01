<?php

namespace Database\Seeders;

use App\Models\VaiTro;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VaiTroSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
     public function run(): void
    {
        // Thứ tự ID rất quan trọng để tạo mã tài khoản chính xác
        $roles = [
            ['ten_vai_tro' => 'Quản trị'], // id=1
            ['ten_vai_tro' => 'Phòng đào tạo'], // id=2
            ['ten_vai_tro' => 'Tiểu đoàn trưởng'], // id=3
            ['ten_vai_tro' => 'Đại đội trưởng'], // id=4
            ['ten_vai_tro' => 'Giảng viên'], // id=5
            ['ten_vai_tro' => 'Học viên'], // id=6
        ];

        foreach ($roles as $role) {
            VaiTro::create($role);
        }
    }
}
