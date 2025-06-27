<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'quiz_id',
        'start_time',
        'end_time',
        'score',
        'correction'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }
     public function answers()
    {
        return $this->belongsToMany(Answer::class ,'answer_history');
    }
}
