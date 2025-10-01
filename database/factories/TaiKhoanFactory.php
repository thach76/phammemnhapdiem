<?php

namespace Database\Factories;

use App\Models\TaiKhoan;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TaiKhoan>
 */
class TaiKhoanFactory extends Factory
{
    // Cấu trúc TĐ - ĐĐ cố định
    private const DON_VI_STRUCTURE = [
        // TĐ [Mã TĐ 2 chữ số] => [Mã ĐĐ 2 chữ số/chuỗi]
        '02' => ['01', '02', '03'], // TĐ 2 có ĐĐ 1-3
        '03' => ['04', '05', '06', '07'], // TĐ 3 có ĐĐ 4-7
        '04' => ['08', '09', '10', '8A'], // TĐ 4 có ĐĐ 8, 9, 10, 8A
        '05' => ['11', '12', '13'], // TĐ 5 có ĐĐ 11-13
    ];
    
    public function definition(): array
    {
        $ma_tam_thoi = 'TEMP_' . $this->faker->unique()->randomNumber(5);

        return [
            'ma_tai_khoan' => $ma_tam_thoi, // <-- Sửa tại đây
            'mat_khau' => Hash::make('password'),
            'vai_tro_id' => 1, 
            'ho_ten' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'so_dien_thoai' => $this->faker->phoneNumber(),
        ];
    }
    
    public function configure(): static
    {
        return $this->afterCreating(function (TaiKhoan $taiKhoan) {
            $vaiTroId = $taiKhoan->vai_tro_id;
            $id = $taiKhoan->id;
            $ma_tai_khoan = '';

            switch ($vaiTroId) {
                // ... (Case 1, 2, 3: Giữ nguyên)
                case 1: // Quản trị: ADMBKH
                    $ma_tai_khoan = 'ADMBKH';
                    break;
                case 2: // Phòng đào tạo: PDT001-PDT009
                    $ma_tai_khoan = 'PDT' . str_pad($id, 3, '0', STR_PAD_LEFT);
                    break;
                case 3: // Tiểu đoàn trưởng: TD0001
                    // Lấy ngẫu nhiên TĐ 2-5 (TĐ 1 không có ĐĐ, không cần TĐ trưởng cấp Đại đội?)
                    $stt_tieu_doan = str_pad($this->faker->numberBetween(2, 5), 4, '0', STR_PAD_LEFT);
                    $ma_tai_khoan = 'TD' . $stt_tieu_doan;
                    break;
                
                case 4: // Đại đội trưởng: DD0101 (DD[Mã ĐĐ][Mã TĐ])
                    $tieuDoanCodes = array_keys(self::DON_VI_STRUCTURE);
                    // Chọn ngẫu nhiên một Mã Tiểu đoàn (02, 03, 04, 05)
                    $ma_tieu_doan = $this->faker->randomElement($tieuDoanCodes); 
                    
                    // Lấy danh sách Đại đội của Tiểu đoàn đó
                    $daiDoiList = self::DON_VI_STRUCTURE[$ma_tieu_doan];
                    // Chọn ngẫu nhiên một Mã Đại đội trong danh sách
                    $ma_dai_doi = $this->faker->randomElement($daiDoiList);
                    
                    // Xử lý trường hợp đặc biệt: DD8A04
                    if ($ma_dai_doi === '8A') {
                        $ma_tieu_doan_8A = '04'; // TĐ 4
                        $ma_tai_khoan = 'DD' . $ma_dai_doi . $ma_tieu_doan_8A; // DD8A04
                    } else {
                        // Trường hợp thông thường
                        $ma_tai_khoan = 'DD' . $ma_dai_doi . $ma_tieu_doan; 
                    }
                    break;
                    
                // ... (Case 5, 6: Giữ nguyên)
                case 5: // Giảng viên: GVA101
                    $ma_khoa = $this->faker->randomElement(['HT', 'BC', 'XH', 'QS', 'CM']);
                    $ma_to = $this->faker->numberBetween(1, 9);
                    $stt = str_pad($this->faker->numberBetween(1, 99), 2, '0', STR_PAD_LEFT);
                    $ma_tai_khoan = 'GV' . $ma_khoa . $ma_to . $stt;
                    break;
                case 6: // Học viên: Mã Học viên được tạo trong Học viên Factory
                    $ma_tai_khoan = 'HV' . str_pad($id, 4, '0', STR_PAD_LEFT);
                    break;
                default:
                    $ma_tai_khoan = 'TK' . $id;
            }

            $taiKhoan->forceFill(['ma_tai_khoan' => $ma_tai_khoan])->save();
        });
    }
}
