<?php

namespace Database\Factories;

use App\Models\Department;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;

class SubjectFactory extends Factory
{
    public function definition(): array
    {
        static $order = 1;
        $faculties = ['HT', 'BC', 'XH', 'QS', 'CM'];
        $faculty = $this->faker->randomElement($faculties);
        $group = $this->faker->numberBetween(1,3);
        $code = $faculty . $group . str_pad($order++, 2, '0', STR_PAD_LEFT);

        return [
            'subject_code' => $code,
            'subject_name' => ucfirst($this->faker->word) . ' học',
            'department_id' => Department::inRandomOrder()->first()->id ?? Department::factory(),
            'group_id' => Group::inRandomOrder()->first()->id ?? Group::factory(),
        ];
    }
}
