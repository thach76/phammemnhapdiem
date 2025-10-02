<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;

    protected $table = 'classes'; // bắt buộc vì model tên khác
    protected $fillable = [
        'class_code',
        'class_name',
        'academic_year',
    ];

    // Relationships
    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }
}
