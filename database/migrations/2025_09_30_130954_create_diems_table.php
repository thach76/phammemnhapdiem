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
        Schema::create('diems', function (Blueprint $table) {
            $table->id();
            
            // hoc_vien_id INT FK -> hoc_vien.id
            $table->foreignId('hoc_vien_id')->constrained('hoc_viens');
            // mon_hoc_id INT FK -> mon_hoc.id
            $table->foreignId('mon_hoc_id')->constrained('mon_hocs');
            
            // diem_so DECIMAL(5,2)
            $table->decimal('diem_so', 5, 2);
            
            // nguoi_nhap_id INT FK -> tai_khoan.id
            $table->foreignId('nguoi_nhap_id')->constrained('tai_khoans');
            
            // ngay_nhap TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            $table->timestamp('ngay_nhap')->useCurrent();
            
            // Thường thì điểm của 1 học viên cho 1 môn học là duy nhất
            $table->unique(['hoc_vien_id', 'mon_hoc_id']); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diems');
    }
};
