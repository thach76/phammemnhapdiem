<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LopHoc extends Model
{
    use HasFactory;
    
    // Bảng này không có created_at và updated_at
    public $timestamps = false; 

    protected $fillable = [
        'ma_lop', 
        'ten_lop', 
        'khoa_id', 
        'nam_nhap_hoc',
    ];
    
    // Mối quan hệ: Một Lớp thuộc về một Khoa
    public function khoa() {
        return $this->belongsTo(Khoa::class, 'khoa_id');
    }
}
