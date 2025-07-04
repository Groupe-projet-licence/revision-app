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
        $quiz->load(['questions.answers']);
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

$total = 0;
$obtained = 0;

foreach ($data['answers'] as $questionId => $selectedIds) {
    $question = Question::with('answers')->find($questionId);
    $correctAnswers = $question->answers->where('is_correct', true);
    $allCorrectIds = $correctAnswers->pluck('id')->toArray();
    $selectedIds = is_array($selectedIds) ? $selectedIds : [$selectedIds];

    $total += count($allCorrectIds);

    foreach ($selectedIds as $answerId) {
        SubmissionAnswer::create([
            'quiz_submission_id' => $submission->id,
            'question_id' => $questionId,
            'answer_id' => $answerId,
        ]);
    }

    // Score partiel basé sur les bonnes réponses choisies
    $correctSelected = collect($selectedIds)->intersect($allCorrectIds)->count();
    $incorrectSelected = collect($selectedIds)->diff($allCorrectIds)->count();

    // Pénalité si réponses fausses
    $partial = max($correctSelected - $incorrectSelected, 0);
    $obtained += $partial;
}

// Calcul du pourcentage
$percentage = $total > 0 ? round(($obtained / $total) * 100, 2) : 0;

$submission->update(['score' => $percentage]);

return redirect()->route('quiz.result', $submission->id);
}

public function result($id){
     $submission = QuizSubmission::with([ 'answers.answer','answers.question.answers' // toutes les réponses pour la question
                ])->findOrFail($id);
                return Inertia::render('Quiz/Result', [
                    'submission' => $submission,
                ]);
        }
}




