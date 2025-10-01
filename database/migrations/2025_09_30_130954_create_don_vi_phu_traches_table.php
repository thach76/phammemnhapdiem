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
        Schema::create('don_vi_phu_trachs', function (Blueprint $table) {
            $table->id();
            
            // tai_khoan_id INT FK -> tai_khoan.id
            $table->foreignId('tai_khoan_id')->constrained('tai_khoans');
            
            // don_vi_id INT (Đây là cột đặc biệt, có thể tham chiếu đến nhiều bảng: lớp, đại đội, tiểu đoàn. 
            // Trong Laravel, trường hợp này thường dùng **Polymorphic Relationships**, nhưng để đơn giản, 
            // ta dùng chỉ là một cột INT, và không đặt Foreign Key ràng buộc.)
            $table->unsignedBigInteger('don_vi_id'); 
            
            // vai_tro_trong_don_vi NVARCHAR(50)
            $table->string('vai_tro_trong_don_vi', 50);
            
            // Bạn có thể thêm cặp UNIQUE nếu cần: $table->unique(['tai_khoan_id', 'don_vi_id']);
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('don_vi_phu_traches');
    }
};
