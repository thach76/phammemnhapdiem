<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToBoMon extends Model
{
    use HasFactory;
    
    // Bảng này không có created_at và updated_at
    public $timestamps = false; 

    protected $fillable = [
        'ma_to', 
        'ten_to', 
        'khoa_id',
    ];
    
    // Mối quan hệ: Một Tổ thuộc về một Khoa
    public function khoa() {
        return $this->belongsTo(Khoa::class, 'khoa_id');
    }
}
