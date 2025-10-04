<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo roles nếu chưa có
        $roles = ['admin', 'training_officer', 'brigade_leader', 'company_leader', 'teacher', 'student'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role]);
        }

        // Tạo Admin
        $admin = User::factory()->create([
            'name' => 'ADMBKH',
            'email' => 'admbkh@example.com',
        ]);
        $admin->assignRole('admin');

        // Tạo 5 phòng đào tạo
        for ($i=1; $i<=5; $i++) {
            $user = User::factory()->create([
                'name' => 'PDT' . str_pad($i,3,'0',STR_PAD_LEFT),
                'email' => 'pdt' . $i . '@example.com',
            ]);
            $user->assignRole('training_officer');
        }

        // Tạo 3 tiểu đoàn trưởng
        for ($i=1; $i<=3; $i++) {
            $user = User::factory()->create([
                'name' => 'TD' . str_pad($i,4,'0',STR_PAD_LEFT),
                'email' => 'td' . $i . '@example.com',
            ]);
            $user->assignRole('brigade_leader');
        }

        // Tạo 5 đại đội trưởng
        for ($i=1; $i<=5; $i++) {
            $user = User::factory()->create([
                'name' => 'DD' . str_pad($i,4,'0',STR_PAD_LEFT),
                'email' => 'dd' . $i . '@example.com',
            ]);
            $user->assignRole('company_leader');
        }

        // Tạo 10 giảng viên
        for ($i=1; $i<=10; $i++) {
            $user = User::factory()->create([
                'name' => 'GV' . $i,
                'email' => 'gv' . $i . '@example.com',
            ]);
            $user->assignRole('teacher');
        }

        // Tạo 50 học viên
        for ($i=1; $i<=50; $i++) {
            $user = User::factory()->create([
                'name' => 'H' . $i,
                'email' => 'h' . $i . '@example.com',
            ]);
            $user->assignRole('student');
        }
    }
}
