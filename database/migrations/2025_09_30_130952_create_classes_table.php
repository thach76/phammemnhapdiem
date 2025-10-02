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
        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->string('class_code')->unique();     // Mã lớp, ví dụ: L25TVTD (trong đó L là lớp, 25 là năm, TVTD là chuyên ngành)
            $table->string('class_name');               // Tên lớp: vo tuyen dien
            $table->year('academic_year');              // Niên khóa: 2022, 2023...
            $table->timestamps();

            // Nếu sau này bạn tạo bảng faculties thì mới thêm FK
            // $table->foreign('faculty_id')->references('id')->on('faculties')->onDelete('set null');
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
