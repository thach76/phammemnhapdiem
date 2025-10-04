<?php

// database/migrations/2025_10_03_000001_create_departments_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('department_code')->unique(); // HT, BC, XH, QS, CM
            $table->string('department_name');           // BCHT, BC, KHXHNV, QSĐP, CMKT
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('departments');
    }
};
