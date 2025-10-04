<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['subject_code', 'subject_name', 'department_id', 'group_id'];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function classes()
    {
        return $this->belongsToMany(Classroom::class, 'class_subject');
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }
}
