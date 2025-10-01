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
        Schema::create('to_bo_mons', function (Blueprint $table) {
            $table->id();
            $table->string('ma_to', 10);
            $table->string('ten_to', 100);
            
            // khoa_id INT FK -> khoa.id
            $table->foreignId('khoa_id')->constrained('khoas'); // unsignedBigInteger + Foreign Key
            
            // UNIQUE(ma_to, khoa_id)
            $table->unique(['ma_to', 'khoa_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('to_bo_mons');
    }
};
