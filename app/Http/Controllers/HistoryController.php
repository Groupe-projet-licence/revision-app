<?php
 namespace App\Http\Controllers;
  use App\Models\History;
  use App\Models\Quiz;
  use App\Models\Question;
  use App\Models\Answer;
  use Illuminate\Http\Request;
  use Illuminate\Support\Facades\Auth;
  use Inertia\Inertia;

class HistoryController extends Controller {

<<<<<<< HEAD
   // Affiche la liste des historiques du quiz pour l'utilisateur connecté
   public function index() {
    $histories = History::with('quiz')->where('user_id',
    Auth::id())->get(); return Inertia::render('History/Index',
    [ 'histories' => $histories, ]);
  }


    // Démarre un nouveau quiz et enregistre l'heure de début
    public function start(Quiz $quiz) {
        $history = History::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,
            'start_time' => now(),
         ]);
         return Inertia::render('Quiz/Evaluate',[ 'quiz' => $quiz->load(['questions.answers']), 'history' => $history, ]);
        }


    // Soumission du quiz avec évaluation et enregistrement des réponses
    public function submit(Request $request, Quiz $quiz) {
     $data = $request->validate([
        'answers' => 'required|array',
        'history_id'=> 'required|exists:histories,id',
    ]);
    $scoreTotal = 0;
    $scoreMax = 0;
    $corrections = [];

    foreach ($data['answers'] as $questionId => $selectedIds) {
        $question = Question::with('answers')->findOrFail($questionId);
        $correctAnswers = $question->answers->where('is_correct', true)->pluck('id')->sort()->values();
         $selected = collect($selectedIds)->sort()->values();
         $nbCorrect = $correctAnswers->count(); $nbMatched = $selected->intersect($correctAnswers)->count();

          // Pourcentage obtenu pour cette question
         $percent = $nbCorrect > 0 ? ($nbMatched / $nbCorrect) : 0; $scoreTotal += $percent;
          $scoreMax += 1;
           $corrections[$question->id] = [
            'selected' => $selected->toArray(),
            'correct' => $correctAnswers->toArray(),
            'score' => round($percent * 100), ];
        }

        $finalScore = $scoreMax > 0 ? round(($scoreTotal / $scoreMax) * 100) : 0;
         $history = History::findOrFail($data['history_id']);
          $history->update([
            'end_time' => now(),
            'score' => $finalScore,
            'correction' => json_encode($corrections),
       ]);
          return redirect()->route('histories.result', $history->id);
    }


         // Affiche le détail d'un historique avec correction
    public function result(History $history) {
         $history->load('quiz.questions.answers');
          return Inertia::render('History/Result', [
            'history' => $history,
            'corrections' => json_decode($history->correction, true),
         ]);
     }
=======
use App\Models\History;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{
    public function index()
    {
        $histories = History::where('user_id', Auth::id())->with('quiz')->get();
        return view('histories.index', compact('histories'));
    }

    public function start(Quiz $quiz)
    {
        $history = History::create([
            'user_id' => Auth::id(),
            'quiz_id' => $quiz->id,
            'start_time' => now(),
        ]);

        return view('histories.start', compact('quiz', 'history'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $questions = $quiz->questions;
        $correct = 0;
        $correction = [];

        foreach ($questions as $question) {
            $userAnswer = $request->input('question_' . $question->id);
            $correctAnswers = $question->answers->where('is_correct', true)->pluck('id')->toArray();

            if ($question->type === 'single') {
                if (in_array($userAnswer, $correctAnswers)) {
                    $correct++;
                    $correction[$question->id] = 'correct';
                } else {
                    $correction[$question->id] = 'incorrect';
                }
            } elseif ($question->type === 'multiple') {
                $userAnswers = $userAnswer ?? [];
                sort($userAnswers);
                sort($correctAnswers);
                if ($userAnswers == $correctAnswers) {
                    $correct++;
                    $correction[$question->id] = 'correct';
                } else {
                    $correction[$question->id] = 'incorrect';
                }
            }
        }

        $score = round(($correct / count($questions)) * 100);

        $history = History::find($request->input('history_id'));
        $history->update([
            'end_time' => now(),
            'score' => $score,
            'correction' => json_encode($correction),
        ]);

        return redirect()->route('histories.result', $history->id);
    }

    public function result(History $history)
    {
        return view('histories.result', compact('history'));
    }
>>>>>>> 5717658 (passer un quiz)
}
