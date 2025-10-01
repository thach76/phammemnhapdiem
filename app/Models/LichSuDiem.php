<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LichSuDiem extends Model
{
    use HasFactory;
    
    // Cột created_at của bạn là thoi_gian
    const CREATED_AT = 'thoi_gian'; 
    // Vô hiệu hóa updated_at
    const UPDATED_AT = null; 

    protected $fillable = [
        'diem_id', 
        'hanh_dong', 
        'gia_tri_cu', 
        'gia_tri_moi', 
        'nguoi_thuc_hien_id',
    ];
}
