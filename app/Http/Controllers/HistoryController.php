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
}
