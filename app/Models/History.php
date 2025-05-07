<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $fillable = ['question_id', 'user_answers', 'is_correct'];

    protected $casts = [
        'user_answers' => 'array', //Pour decoder le JSON automatiquement
    ];

    public function question(){
        return $this->belongsTo(Question::class);
    }
}
