<?php

namespace App\Mail;

use App\Models\Quiz;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuizShared extends Mailable
{
    use Queueable, SerializesModels;

    public $quiz;
    public $sender;

    public function __construct(Quiz $quiz, User $sender)
    {
        $this->quiz = $quiz;
        $this->sender = $sender;
    }

    public function build()
    {
        return $this->subject('Un quiz vous a été partagé via EasyLearning')
            ->markdown('emails.quiz.shared');
    }
}
