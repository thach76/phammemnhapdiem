<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // $this->call([
        //     VaiTroSeeder::class, 
        //     ToBoMonSeeder::class, // Gọi Seeder riêng biệt
        //     DemoDataSeeder::class, // Chỉ tạo dữ liệu phức tạp còn lại
        // ]);

        // Role::create(['name' => 'admin']);
        // Role::create(['name' => 'teacher']);
        // Role::create(['name' => 'student']);
        // Role::create(['name'=> 'pdt']);
        $this->call(TestDataSeeder::class);

    }

}
