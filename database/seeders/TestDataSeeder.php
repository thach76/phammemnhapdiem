<?php

namespace Database\Seeders;

use App\Models\ClassModel;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ClassModel::factory()->count(5)->create();
        // User::factory()->count(20)->create();
        // Student::factory()->count(20)->create();
        Teacher::factory()->count(10)->create();

    }
}
