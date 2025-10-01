<?php

namespace Database\Seeders;

use App\Models\Khoa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KhoaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $khoas = [
            ['ma_khoa' => 'HT', 'ten_khoa' => 'Khoa Binh chủng hợp thành'],
            ['ma_khoa' => 'BC', 'ten_khoa' => 'Khoa BC'],
            ['ma_khoa' => 'XH', 'ten_khoa' => 'Khoa Khoa học Xã hội và Nhân văn'],
            ['ma_khoa' => 'QS', 'ten_khoa' => 'Khoa Quân sự địa phương'],
            ['ma_khoa' => 'CM', 'ten_khoa' => 'Khoa CMKT'],
        ];

        foreach ($khoas as $khoa) {
            Khoa::create($khoa);
        }
    }

}
