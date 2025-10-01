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
        Schema::create('lop_hocs', function (Blueprint $table) {
            $table->id();
            // ma_lop VARCHAR(20) UNIQUE
            $table->string('ma_lop', 20)->unique();
            // ten_lop NVARCHAR(100)
            $table->string('ten_lop', 100);
            
            // khoa_id INT FK -> khoa.id
            $table->foreignId('khoa_id')->constrained('khoas');
            
            // nam_nhap_hoc INT
            $table->unsignedSmallInteger('nam_nhap_hoc'); // INT nhỏ hơn, không âm
            
            // $table->timestamps(); // Nên thêm nếu cần quản lý thời gian tạo/cập nhật
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lop_hocs');
    }
};
