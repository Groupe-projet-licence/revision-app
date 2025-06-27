<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizSubmission extends Model
{
    protected $fillable = ['user_id', 'quiz_id', 'score'];

    public function answers(): HasMany
    {
        return $this->hasMany(SubmissionAnswer::class);
    }
}
