<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FacultyFactory extends Factory
{
    public function definition(): array
    {
        // Danh sách khoa cố định
        $faculties = [
            ['name' => 'Binh chủng hợp thành', 'abbr' => 'HT'],
            ['name' => 'Binh chủng', 'abbr' => 'BC'],
            ['name' => 'Khoa học xã hội & nhân văn', 'abbr' => 'XH'],
            ['name' => 'Quân sự địa phương', 'abbr' => 'QS'],
            ['name' => 'Chuyên môn kỹ thuật', 'abbr' => 'CM'],
        ];

        $faculty = $this->faker->unique()->randomElement($faculties);

        return [
            'faculty_code' => $faculty['abbr'],
            'faculty_name' => $faculty['name'],
        ];
    }
}
