<?php

namespace Database\Factories;

use App\Models\Khoa;
use App\Models\ToBoMon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MonHoc>
 */
class MonHocFactory extends Factory
{
    public function definition(): array
    {
        // Lấy ngẫu nhiên một Khoa và Tổ đã tồn tại
        $khoa = Khoa::all()->random();
        // Lấy Tổ thuộc Khoa đó, nếu không có thì lấy ngẫu nhiên
        $to_bo_mon = ToBoMon::where('khoa_id', $khoa->id)->get()->random() ?? ToBoMon::all()->random();

        $stt = str_pad($this->faker->numberBetween(1, 99), 2, '0', STR_PAD_LEFT);
        
        // Quy tắc: [Mã Khoa] + [Mã Tổ (chỉ lấy số cuối)] + [STT]
        $ma_khoa_don = substr($khoa->ma_khoa, 0, 1); // Lấy chữ cái đầu (Vd: H của HT)
        $ma_to_don = substr($to_bo_mon->ma_to, -1); // Giả sử mã tổ là TBMX, lấy X

        $ma_mon_goc = $ma_khoa_don . $ma_to_don . $stt;

        return [
            'ma_mon' => $ma_mon_goc . $this->faker->unique()->randomNumber(3), // Đảm bảo mã môn duy nhất
            'ten_mon' => 'Môn ' . $this->faker->catchPhrase(),
            'khoa_id' => $khoa->id,
            'to_id' => $to_bo_mon->id,
            'so_tin_chi' => $this->faker->numberBetween(2, 5),
        ];
    }
}
