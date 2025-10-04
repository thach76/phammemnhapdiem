<?php

// database/migrations/2025_10_03_000003_create_classrooms_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('classrooms', function (Blueprint $table) {
            $table->id();
            $table->string('class_code')->unique(); // L25TVTD
            $table->string('class_name');
            $table->string('major');   // chuyên ngành
            $table->year('year');      // năm nhập học
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('set null');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('classrooms');
    }
};
