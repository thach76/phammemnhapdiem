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
        Schema::create('lich_su_diems', function (Blueprint $table) {
            $table->id();
            
            // diem_id INT FK -> diem.id
            $table->foreignId('diem_id')->constrained('diems');
            
            // hanh_dong NVARCHAR(20)
            $table->string('hanh_dong', 20)->comment('thêm, sửa, xoá');
            // gia_tri_cu NVARCHAR(255)
            $table->text('gia_tri_cu')->nullable(); // Dùng text cho nội dung lớn hơn
            // gia_tri_moi NVARCHAR(255)
            $table->text('gia_tri_moi')->nullable();
            
            // thoi_gian TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('thoi_gian')->useCurrent();
            
            // nguoi_thuc_hien_id INT FK -> tai_khoan.id
            $table->foreignId('nguoi_thuc_hien_id')->constrained('tai_khoans');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lich_su_diems');
    }
};
