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
        Schema::create('vai_tros', function (Blueprint $table) {
            $table->id(); // Tương đương: id INT AUTO_INCREMENT PRIMARY KEY
            // ten_vai_tro NVARCHAR(50)
            $table->string('ten_vai_tro', 50)->comment('Quản trị, Phòng đào tạo, Giảng viên...');
            // Không có cột created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vai_tros');
    }
};
