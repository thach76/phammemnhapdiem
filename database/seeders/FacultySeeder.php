<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Faculty;

class FacultySeeder extends Seeder
{
    public function run(): void
    {
        $faculties = [
            ['faculty_code' => 'HT', 'name' => 'Bộ chỉ huy tham mưu'],
            ['faculty_code' => 'BC', 'name' => 'Bộ chính trị'],
            ['faculty_code' => 'XH', 'name' => 'Khoa học xã hội & nhân văn'],
            ['faculty_code' => 'QS', 'name' => 'Quân sự địa phương'],
            ['faculty_code' => 'CM', 'name' => 'Chuyên môn kỹ thuật'],
        ];

    }
}
