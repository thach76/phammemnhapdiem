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
        Schema::create('khoas', function (Blueprint $table) {
            $table->id();
            // ma_khoa VARCHAR(10) UNIQUE
            $table->string('ma_khoa', 10)->unique();
            // ten_khoa NVARCHAR(100)
            $table->string('ten_khoa', 100);
            // Không có cột created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khoas');
    }
};
