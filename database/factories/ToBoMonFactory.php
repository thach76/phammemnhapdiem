<?php

namespace Database\Factories;

use App\Models\Khoa;
use App\Models\ToBoMon; 
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ToBoMon>
 */
class ToBoMonFactory extends Factory
{
    protected $model = ToBoMon::class;
    // Bỏ biến tĩnh self::$sttTo
    
    public function definition(): array
    {
        // Factory này sẽ chỉ được gọi khi Seeder đã cung cấp khoa_id và stt_to
        // Mặc định, nó sẽ tạo mã tổ đơn giản cho mục đích tạo FK.
        return [
            'ma_to' => $this->faker->unique()->bothify('??#'), 
            'ten_to' => $this->faker->sentence(3),
            // khoa_id sẽ được cung cấp từ Seeder hoặc tự động liên kết nếu không có.
            'khoa_id' => Khoa::all()->random()->id,
        ];
    }

    /**
     * State để tạo mã Tổ theo quy tắc [Mã Khoa][STT]
     * Chúng ta sẽ dùng state này và truyền tham số từ Seeder.
     */
    public function withStt(Khoa $khoa, int $stt): Factory
    {
        $ma_khoa = $khoa->ma_khoa;
        $sttTo = $stt;
        $ma_to = $ma_khoa . $sttTo; // Ví dụ: HT1, BC2

        return $this->state(function (array $attributes) use ($ma_to, $khoa, $sttTo) {
            return [
                'ma_to' => $ma_to,
                'ten_to' => 'Tổ Bộ Môn ' . $sttTo . ' - Khoa ' . $khoa->ten_khoa,
                'khoa_id' => $khoa->id,
            ];
        });
    }
}