<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VaiTro extends Model
{
    use HasFactory;
    
    // Yêu cầu Laravel không quản lý các cột created_at và updated_at
    public $timestamps = false; 

    protected $fillable = [
        'ten_vai_tro',
    ];
}
