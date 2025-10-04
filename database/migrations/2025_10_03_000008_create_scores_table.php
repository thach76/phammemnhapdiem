<?php

// database/migrations/2025_10_03_000008_create_scores_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('scores', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained()->onDelete('cascade');
            $table->foreignId('class_subject_id')->constrained('class_subject')->onDelete('cascade');
            $table->foreignId('teacher_id')->nullable()->constrained()->onDelete('set null');
            $table->float('score')->nullable();
            $table->boolean('approved')->default(false); // phòng đào tạo duyệt
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('scores');
    }
};
