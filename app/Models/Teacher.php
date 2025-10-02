<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_code',
        'user_id',
        'full_name',
        'birth_date',
        'gender',
        'specialization',
    ];

    // Quan hệ với user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
