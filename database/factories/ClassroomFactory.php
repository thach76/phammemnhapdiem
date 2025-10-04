<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Department; // Cần dùng để lấy ID khoa/ban

class ClassroomFactory extends Factory
{
    public function definition(): array
    {
        static $order = 1; // tăng mỗi lần tạo lớp
        $year = now()->format('y');
        $majors = ['TVTD','QSTT','CNTT','CTXH'];
        $major = $this->faker->randomElement($majors); // Lấy giá trị ngẫu nhiên
        
        // Tạo mã lớp học duy nhất (code)
        $code = 'L' . $year . $major . str_pad($order++, 2, '0', STR_PAD_LEFT);

        return [
            'class_code' => $code,
            'class_name' => 'Lớp ' . $major . ' K' . $year,
            // ✅ BỔ SUNG CỘT THIẾU (Nguyên nhân gây lỗi)
            'major' => $major, 
            
            'year' => '20' . $year,
            
            // ✅ BỔ SUNG KHÓA NGOẠI (Nếu Migration của bạn có cột này)
            'department_id' => Department::inRandomOrder()->first()->id ?? 1, 
            // Lưu ý: Đảm bảo DepartmentSeeder đã chạy trước để có ID
        ];
    }
}