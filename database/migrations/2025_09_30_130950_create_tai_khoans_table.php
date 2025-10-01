<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tai_khoans', function (Blueprint $table) {
            $table->id();
            // ma_tai_khoan VARCHAR(50) UNIQUE
            $table->string('ma_tai_khoan', 50)->unique(); 
            // mat_khau VARCHAR(255)
            $table->string('mat_khau');
            
            // vai_tro_id INT FK -> vai_tro.id
            $table->foreignId('vai_tro_id')->constrained('vai_tros');
            
            // ho_ten NVARCHAR(100)
            $table->string('ho_ten', 100);
            // email VARCHAR(100)
            $table->string('email', 100)->nullable(); // Có thể cho phép NULL
            // so_dien_thoai VARCHAR(20)
            $table->string('so_dien_thoai', 20)->nullable();
            
            // ngay_tao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            // Laravel có sẵn $table->timestamps() nhưng bạn yêu cầu chỉ có ngay_tao.
            $table->timestamp('ngay_tao')->useCurrent();
            // Nếu bạn muốn lưu cả thời gian cập nhật (nên dùng): $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tai_khoans');
    }
};
