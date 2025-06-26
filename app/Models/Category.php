<?php

namespace App\Models;

use App\Models\Quiz;
use App\Models\Sheet;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['subject', 'level'];

    public function questions(){
        return $this->hasMany(Question::class);
    }

    //Partie modifier
    public function quizzes(){
        return $this->hasMany(Quiz::class);
    }

    public function sheets(){
        return $this->hasMany(Sheet::class);
    }
}
