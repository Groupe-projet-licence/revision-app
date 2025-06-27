<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubmissionAnswer extends Model
{
<<<<<<< HEAD
    protected $fillable = ['quiz_submission_id', 'question_id', 'answer_id'];
=======
    protected $fillable = ['quiz_submission_id', 'question_id', 'option_id'];
>>>>>>> 5717658 (passer un quiz)

    public function question()
    {
        return $this->belongsTo(Question::class);
    }

<<<<<<< HEAD
    public function Answer()
    {
        return $this->belongsTo(Answer::class);
=======
    public function option()
    {
        return $this->belongsTo(Option::class);
>>>>>>> 5717658 (passer un quiz)
    }
}
