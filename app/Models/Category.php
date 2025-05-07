<?php

namespace App\Models;

use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['subject'];

    public function questions(){
        return $this->hasMany(Question::class);
    }
}
