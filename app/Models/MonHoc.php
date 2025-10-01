<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    use HasFactory;
    
    // Bảng này không có created_at và updated_at
    public $timestamps = false; 

    protected $fillable = [
        'ma_mon', 
        'ten_mon', 
        'khoa_id', 
        'to_id', 
        'so_tin_chi',
    ];
    
    // Bạn có thể thêm các mối quan hệ cho Khoa và Tổ ở đây nếu cần.
}
