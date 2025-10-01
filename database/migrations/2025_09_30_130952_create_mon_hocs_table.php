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
        Schema::create('mon_hocs', function (Blueprint $table) {
            $table->id();
            // ma_mon VARCHAR(20) UNIQUE
            $table->string('ma_mon', 20)->unique();
            // ten_mon NVARCHAR(100)
            $table->string('ten_mon', 100);
            
            // khoa_id INT FK -> khoa.id
            $table->foreignId('khoa_id')->constrained('khoas');
            // to_id INT FK -> to_bo_mon.id
            $table->foreignId('to_id')->constrained('to_bo_mons');
            
            // so_tin_chi INT
            $table->unsignedTinyInteger('so_tin_chi'); // INT rất nhỏ, không âm
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mon_hocs');
    }
};
