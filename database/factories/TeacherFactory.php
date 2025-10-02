<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Teacher;
use App\Models\User;

class TeacherFactory extends Factory
{
    protected $model = Teacher::class;

    public function definition(): array
    {
        // Tạo user
        $user = User::factory()->create();
        $user->assignRole('teacher');

        // Tạo mã giảng viên: GV001, GV002…
        static $stt = 1;
        $teacher_code = 'GV' . str_pad($stt++, 3, '0', STR_PAD_LEFT);

        return [
            'teacher_code' => $teacher_code,
            'user_id' => $user->id,
            'full_name' => $this->faker->name,
            'birth_date' => $this->faker->date('Y-m-d', '1980-01-01'),
            'gender' => $this->faker->randomElement(['male','female']),
            'specialization' => $this->faker->randomElement(['BCHT','BC','KHXHNV', 'QSDP', 'CMKT']),
        ];
    }
}
