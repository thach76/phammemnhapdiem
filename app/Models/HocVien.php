<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HocVien extends Model
{
    use HasFactory;
    
    // Cột created_at của bạn là ngay_tao
    const CREATED_AT = 'ngay_tao';
    // Vô hiệu hóa updated_at
    const UPDATED_AT = null; 

    protected $fillable = [
        'ma_hoc_vien', 
        'tai_khoan_id', 
        'lop_id', 
        'ngay_sinh', 
        'gioi_tinh', 
        'que_quan',
    ];
    
    // Mối quan hệ: Một Học viên thuộc về một Lớp
    public function lop() {
        return $this->belongsTo(LopHoc::class, 'lop_id');
    }
}
