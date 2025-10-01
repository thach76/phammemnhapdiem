<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DonViPhuTrach extends Model
{
    use HasFactory;
    
    // Bảng này không có created_at và updated_at
    public $timestamps = false; 

    protected $fillable = [
        'tai_khoan_id', 
        'don_vi_id', 
        'vai_tro_trong_don_vi',
    ];
}
