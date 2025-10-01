<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diem extends Model
{
    use HasFactory;
    
    // Cột created_at của bạn là ngay_nhap
    const CREATED_AT = 'ngay_nhap'; 
    // Vô hiệu hóa updated_at
    const UPDATED_AT = null; 

    protected $fillable = [
        'hoc_vien_id', 
        'mon_hoc_id', 
        'diem_so', 
        'nguoi_nhap_id',
    ];
    
    // Các mối quan hệ (Relational mapping)
    public function hocVien() { return $this->belongsTo(HocVien::class, 'hoc_vien_id'); }
    public function monHoc() { return $this->belongsTo(MonHoc::class, 'mon_hoc_id'); }

}
