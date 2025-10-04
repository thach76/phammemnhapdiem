<?php

namespace Database\Factories;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    public function definition(): array
    {
        static $order = 1;
        $year = now()->format('y');
        $majors = ['TVTD','QSTT','CNTT','CTXH'];
        $major = $this->faker->randomElement($majors);
        $code = 'H' . $year . $major . str_pad($order++, 3, '0', STR_PAD_LEFT);

        return [
            'student_code' => $code,
            'name' => $this->faker->name,
            'dob' => $this->faker->date(),
            'hometown' => $this->faker->city,
            'user_id' => User::factory(),
            'classroom_id' => Classroom::inRandomOrder()->first()->id ?? Classroom::factory(),
        ];
    }
}
