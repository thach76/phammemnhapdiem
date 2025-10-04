<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Department extends Model
{
    use HasFactory;

    protected $fillable = ['department_code', 'name'];

    // 1 khoa (department) có nhiều tổ (group)
    public function groups()
    {
        return $this->hasMany(Group::class);
    }

    // 1 khoa có nhiều môn
    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    // 1 khoa có nhiều giảng viên
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }
}
