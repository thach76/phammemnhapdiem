<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\ClassSubject;
use Illuminate\Database\Eloquent\Factories\Factory;

class ScoreFactory extends Factory
{
    public function definition(): array
    {
        return [
            'student_id' => Student::inRandomOrder()->first()->id ?? Student::factory(),
            'class_subject_id' => ClassSubject::inRandomOrder()->first()->id ?? ClassSubject::factory(),
            'teacher_id' => Teacher::inRandomOrder()->first()->id ?? Teacher::factory(),
            'score' => $this->faker->randomFloat(2, 0, 10),
            'status' => $this->faker->randomElement(['pending', 'approved']),
            'approved_by' => null,
        ];
    }
}
