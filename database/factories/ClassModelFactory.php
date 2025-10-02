<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\ClassModel;

class ClassModelFactory extends Factory
{
    protected $model = ClassModel::class;

    public function definition(): array
    {
        // Chuyên ngành mẫu
        $majors = ['TVTD', 'CNTT', 'QTKD'];
        $major = $this->faker->randomElement($majors);

        // Năm khóa
        $year = $this->faker->numberBetween(20, 25); // ví dụ 2020-2025

        // Tạo mã lớp: L25TVTD
        $class_code = 'L' . $year . $major;

        // Tạo tên lớp: Công nghệ thông tin K25
        $class_name = 'Class ' . $major . ' ' . $year;

        return [
            'class_code' => $class_code,
            'class_name' => $class_name,
            'academic_year' => '20' . $year, // 2025
        ];
    }
}
