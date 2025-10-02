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
    Schema::create('students', function (Blueprint $table) {
        $table->id();
        $table->string('student_code')->unique();   // ma_hoc_vien
        $table->unsignedBigInteger('user_id');      // tai_khoan_id
        $table->unsignedBigInteger('class_id');     // lop_id
        $table->date('birth_date');                 // ngay_sinh
        $table->enum('gender', ['male', 'female']); // gioi_tinh
        $table->string('hometown');                 // que_quan
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('class_id')->references('id')->on('classes')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
