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
        Schema::create('hoc_viens', function (Blueprint $table) {
            $table->id();
            // ma_hoc_vien VARCHAR(20) UNIQUE
            $table->string('ma_hoc_vien', 20)->unique();
            
            // tai_khoan_id INT FK -> tai_khoan.id
            $table->foreignId('tai_khoan_id')->constrained('tai_khoans');
            // lop_id INT FK -> lop_hoc.id
            $table->foreignId('lop_id')->constrained('lop_hocs');
            
            // ngay_sinh DATE
            $table->date('ngay_sinh')->nullable();
            // gioi_tinh NVARCHAR(10)
            $table->string('gioi_tinh', 10)->nullable();
            // que_quan NVARCHAR(255)
            $table->string('que_quan')->nullable();
            
            // ngay_tao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('ngay_tao')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hoc_viens');
    }
};
