<?php

namespace Database\Seeders;

use App\Models\ToBoMon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ToBoMonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Lệnh CLient Code (Seeder gọi Factory):
        // Gọi ToBoMonFactory và tạo 15 bản ghi.
        ToBoMon::factory()->count(15)->create(); 
    }
}
