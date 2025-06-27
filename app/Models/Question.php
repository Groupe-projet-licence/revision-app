<?php

namespace App\Models;

use App\Models\Answer;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = ['question_text', 'category_id', 'type'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }

    public function quizzes()
    {
    return $this->belongsToMany(Quiz::class, 'question_quiz');
    }

    public function options()
    {
    return $this->hasMany(\App\Models\Option::class);
    }

}
