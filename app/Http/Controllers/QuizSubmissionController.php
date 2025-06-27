<?php

namespace App\Http\Controllers;

use App\Models\QuizSubmission;
use App\Models\SubmissionAnswer;
use App\Models\Question;
use App\Models\Quiz;
use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizSubmissionController extends Controller
{
    public function show(Quiz $quiz)
    {
        $quiz->load(['questions.options']);
        return Inertia::render('Quiz/Evaluate', [ 'quiz' => $quiz ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'quiz_id' => 'required|exists:quizzes,id',
            'answers' => 'required|array',
        ]);

        $submission = QuizSubmission::create([
            'user_id' => Auth::id(),
            'quiz_id' => $data['quiz_id'],
        ]);

        $score = 0;
        foreach ($data['answers'] as $questionId => $selectedOptionIds) {
            $question = Question::find($questionId);
            $correctOptionIds = $question->options()->where('is_correct', true)->pluck('id')->sort()->values();
            $selected = collect($selectedOptionIds)->sort()->values();

            if ($selected->toArray() === $correctOptionIds->toArray()) {
                $score++;
            }

            foreach ($selectedOptionIds as $optionId) {
                SubmissionAnswer::create([
                    'quiz_submission_id' => $submission->id,
                    'question_id' => $questionId,
                    'option_id' => $optionId
                ]);
            }
        }

        $submission->update(['score' => $score]);
        return redirect()->route('quiz.result', $submission->id);
    }

    public function result($id)
    {
        $submission = QuizSubmission::with(['answers.option', 'answers.question'])->findOrFail($id);
        return Inertia::render('Quiz/Result', [ 'submission' => $submission ]);
    }
}




