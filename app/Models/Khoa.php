<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Khoa extends Model
{
    use HasFactory;
    
    // Bảng này không có created_at và updated_at
    public $timestamps = false; 

    protected $fillable = [
        'ma_khoa', 
        'ten_khoa',
    ];
}
