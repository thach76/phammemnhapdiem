<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            VaiTroSeeder::class, 
            KhoaSeeder::class,   
            ToBoMonSeeder::class, // Gọi Seeder riêng biệt
            DemoDataSeeder::class, // Chỉ tạo dữ liệu phức tạp còn lại
        ]);
    }
}
