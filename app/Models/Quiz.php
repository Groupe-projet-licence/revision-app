<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description'];

    public function category()
{
    return $this->belongsTo(Category::class);
}

    public function questions()
    {
        return $this->belongsToMany(Question::class, 'question_quiz');
    }




}
