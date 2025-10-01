<?php

namespace Database\Factories;

use App\Models\Khoa;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LopHoc>
 */
class LopHocFactory extends Factory
{
    public function definition(): array
    {
        // Lấy ngẫu nhiên một Khoa đã có ID và mã viết tắt
        $khoa = Khoa::all()->random();
        
        $nam_nhap_hoc = $this->faker->numberBetween(22, 26); // Ví dụ: 25 là năm 2025
        $chuyen_nganh = $khoa->ma_khoa; // Dùng mã Khoa làm chuyên ngành TVTD
        
        $ma_lop = 'L' . $nam_nhap_hoc . $chuyen_nganh . $this->faker->randomLetter();

        return [
            'ma_lop' => $ma_lop,
            'ten_lop' => 'Lớp ' . $chuyen_nganh . $nam_nhap_hoc . ' Khóa ' . $this->faker->numberBetween(10, 20),
            'khoa_id' => $khoa->id,
            'nam_nhap_hoc' => 2000 + $nam_nhap_hoc,
        ];
    }
}
