<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    public function definition(): array
    {
        static $i = 0;
        $faculties = ['HT', 'BC', 'XH', 'QS', 'CM'];
        $codes = ['BCHT', 'BC', 'KHXHNV', 'QSĐP', 'CMKT'];

        $code = $faculties[$i % count($faculties)];
        $name = $codes[$i % count($codes)];
        $i++;

        return [
            'department_code' => $code,
            'department_name' => $name,
        ];
    }
}
