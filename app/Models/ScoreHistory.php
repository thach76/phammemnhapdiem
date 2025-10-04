<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ScoreHistory extends Model
{
    use HasFactory;

    protected $fillable = ['score_id', 'old_value', 'new_value', 'changed_by'];

    public function score()
    {
        return $this->belongsTo(Score::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}
