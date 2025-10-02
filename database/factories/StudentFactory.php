<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Student;
use App\Models\User;
use App\Models\ClassModel;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        // Lấy 1 lớp ngẫu nhiên
        $class = ClassModel::inRandomOrder()->first();

        // Nếu chưa có lớp, tạo một lớp
        if (!$class) {
            $class = ClassModel::factory()->create();
        }

        // Lấy năm + chuyên ngành từ mã lớp
        preg_match('/L(\d+)(\w+)/', $class->class_code, $matches);
        $year = $matches[1];      // 25
        $major = $matches[2];     // TVTD

        // Lấy số thứ tự: ví dụ 001
        static $stt = 1;
        $stt_formatted = str_pad($stt++, 3, '0', STR_PAD_LEFT);

        // Tạo mã học viên: H25TVTD001
        $student_code = 'H' . $year . $major . $stt_formatted;

        // Tạo tài khoản user
        $user = User::factory()->create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('123456'),
        ]);

        // Gán role student
        $user->assignRole('student');

        return [
            'student_code' => $student_code,
            'user_id' => $user->id,
            'class_id' => $class->id,
            'birth_date' => $this->faker->date('Y-m-d', '2005-01-01'),
            'gender' => $this->faker->randomElement(['male','female']),
            'hometown' => $this->faker->city,
        ];
    }
}
