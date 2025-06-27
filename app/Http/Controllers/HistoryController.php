<?php

namespace App\Http\Controllers;

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
}
