<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class GroupFactory extends Factory
{
    public function definition(): array
    {
        static $order = 1;

        return [
            'group_code' => 'G' . str_pad($order++, 2, '0', STR_PAD_LEFT),
            'group_name' => $this->faker->word . ' tổ',
            'department_id' => Department::inRandomOrder()->first()->id ?? Department::factory(),
        ];
    }
}
