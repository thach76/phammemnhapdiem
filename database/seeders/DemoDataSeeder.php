<?php

namespace Database\Seeders;

use App\Models\Diem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ToBoMon;
use App\Models\MonHoc;
use App\Models\LopHoc;
use App\Models\TaiKhoan;
use App\Models\HocVien;

class DemoDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        // Lấy tất cả Khoa đã được tạo từ KhoaSeeder (Mã: HT, BC, XH, QS, CM)
        $khoas = \App\Models\Khoa::all();
        $stts = [1, 2, 3]; // Các số thứ tự Tổ

        // =========================================================================
        // 1. DỮ LIỆU CƠ SỞ (Cần chạy trước để tạo FK cho các bảng khác)
        // =========================================================================

        // 1.1. TẠO TỔ BỘ MÔN (ToBoMon)
        echo "Tạo Tổ Bộ môn (3 Tổ cho mỗi Khoa)...\n";
        
        foreach ($khoas as $khoa) {
             foreach ($stts as $stt) {
                 // Gọi Factory và dùng state withStt để truyền Khoa và STT, đảm bảo duy nhất
                 \App\Models\ToBoMon::factory()->withStt($khoa, $stt)->create();
             }
        }
        
        // 1.2. TẠO LỚP HỌC (LopHoc)
        // Tạo 15 lớp học ngẫu nhiên, liên kết với các Khoa đã có
        echo "Tạo Lớp học (15 lớp)...\n";
        LopHoc::factory()->count(15)->create();

        // 1.3. TẠO MÔN HỌC (MonHoc)
        // Tạo 30 môn học ngẫu nhiên, liên kết với Khoa và Tổ đã tạo
        echo "Tạo Môn học (30 môn)...\n";
        MonHoc::factory()->count(30)->create();
        
        // =========================================================================
        // 2. TẠO TÀI KHOẢN VÀ HỌC VIÊN
        // =========================================================================
        
        echo "Tạo Tài khoản và Học viên...\n";
        
        // 2.1. Tài khoản Quản trị (ID=1) - Mã ADMBKH
        TaiKhoan::factory()->create(['vai_tro_id' => 1, 'ho_ten' => 'Admin Ban Kế Hoạch']);
        
        // 2.2. Phòng Đào tạo (ID=2) - 3 người
        $pdtAccounts = TaiKhoan::factory()->count(3)->create(['vai_tro_id' => 2]);
        $pdtIds = $pdtAccounts->pluck('id')->all(); // [ID2, ID3, ID4]
        
        // 2.3. Tiểu đoàn trưởng (ID=3) - 4 người (cho TĐ 2, 3, 4, 5)
        $tdAccounts = TaiKhoan::factory()->count(4)->create(['vai_tro_id' => 3]);
        $tdIds = $tdAccounts->pluck('id')->all(); // [ID5, ID6, ID7, ID8]
        
        // 2.4. Tài khoản Đại đội trưởng (ID=4) - Mã DDxxxx (13 người cho 13 ĐĐ)
        TaiKhoan::factory()->count(13)->create(['vai_tro_id' => 4]); 

        // 2.5. Tài khoản Giảng viên (ID=5) - Mã GVxxxx
        $giangVienIds = TaiKhoan::factory()->count(15)->create(['vai_tro_id' => 5])->pluck('id');

        // 2.6. Học viên (ID=6) - Mã HxxTVTDxxx
        // Mỗi Học viên sẽ tự động tạo một Tài khoản (vai_tro_id=6) trong HocVienFactory.
        HocVien::factory()->count(100)->create();
        $hocVienIds = HocVien::pluck('id');

        // =========================================================================
        // 3. DỮ LIỆU ĐIỂM (Bảng liên kết/thao tác)
        // =========================================================================
        
        echo "Tạo dữ liệu Điểm...\n";
        
        $monHocIds = MonHoc::pluck('id');
        $diemData = [];

        // Mỗi Học viên nhận điểm cho 5-10 môn ngẫu nhiên
        foreach ($hocVienIds as $hvId) {
            $randomMonHoc = $monHocIds->random(rand(5, 10));
            
            foreach ($randomMonHoc as $mhId) {
                // Kiểm tra xem tổ hợp này đã có điểm chưa (để tránh lỗi UNIQUE)
                if (Diem::where('hoc_vien_id', $hvId)->where('mon_hoc_id', $mhId)->doesntExist()) {
                    $diemData[] = [
                        'hoc_vien_id' => $hvId,
                        'mon_hoc_id' => $mhId,
                        'diem_so' => fake()->randomFloat(2, 4, 10), 
                        // Giảng viên ngẫu nhiên nhập điểm
                        'nguoi_nhap_id' => $giangVienIds->random(), 
                        'ngay_nhap' => now(),
                    ];
                }
            }
        }
        
        // Chèn dữ liệu Điểm hàng loạt
        DB::table('diems')->insert($diemData);
        
        // 4. Bỏ qua lich_su_diem và don_vi_phu_trach trong Seeder để giữ đơn giản.
        // Dữ liệu này thường được tạo thông qua các sự kiện (events) hoặc khi có thao tác thực tế.
        
        echo "Hoàn tất việc gieo hạt dữ liệu Demo!\n";
    }
}