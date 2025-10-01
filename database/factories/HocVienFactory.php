<?php

namespace Database\Factories;

use App\Models\LopHoc;
use App\Models\TaiKhoan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\HocVien>
 */
class HocVienFactory extends Factory
{
    public function definition(): array
    {
        // Tạo Tài khoản cho Học viên (vai_tro_id = 6)
        $taiKhoan = TaiKhoan::factory()->create(['vai_tro_id' => 6]); 
        
        // Lấy ngẫu nhiên một Lớp đã có (để lấy Năm và Chuyên ngành)
        $lop = LopHoc::all()->random();
        $nam_nhap_hoc_2so = substr($lop->nam_nhap_hoc, 2, 2);
        // Lấy chuyên ngành (Mã Khoa) từ Lớp
        $chuyen_nganh = $lop->khoa->ma_khoa; 

        // STT Học viên dựa vào ID của Tài khoản vừa tạo
        $stt = str_pad($taiKhoan->id, 3, '0', STR_PAD_LEFT);
        
        // H + Năm + Chuyên ngành + STT
        $ma_hoc_vien = 'H' . $nam_nhap_hoc_2so . $chuyen_nganh . $stt;

        return [
            'ma_hoc_vien' => $ma_hoc_vien,
            'tai_khoan_id' => $taiKhoan->id,
            'lop_id' => $lop->id,
            'ngay_sinh' => $this->faker->date(),
            'gioi_tinh' => $this->faker->randomElement(['Nam', 'Nữ']),
            'que_quan' => $this->faker->city(),
        ];
    }
}
