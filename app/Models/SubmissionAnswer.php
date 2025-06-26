<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionAnswer extends Model
{
    protected $fillable = ['quiz_submission_id', 'question_id', 'answer_id'];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

    public function Answer()
    {
        return $this->belongsTo(Answer::class);
    }
}
