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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('teacher_code')->unique();  // Mã giảng viên
            $table->unsignedBigInteger('user_id');     // FK → users
            $table->string('full_name');               // Tên đầy đủ
            $table->date('birth_date')->nullable();    // Ngày sinh
            $table->enum('gender', ['male','female'])->nullable(); // Giới tính
            $table->string('specialization')->nullable(); // Chuyên môn
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
