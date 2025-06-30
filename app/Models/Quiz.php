<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
        return $this->hasMany(Question::class);
    }

    // Relation avec l'utilisateur (créateur du quiz)
    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
