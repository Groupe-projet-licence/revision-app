<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\History;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function showCategories(){
        $categories = Category::all();
        return view('quiz.categories', compact('categories'));
    }

    public function showQuestions($categoryId){
        $questions = Question::where('category_id', $categoryId)->with('answers')->inRandomOrder()->get();
        return view('quiz.questions', compact('questions', 'categoryId'));
    }

    //A revoir sa peur souleve une erreur
    public function submitAnswers(Request $request){
        //Pour les bonnes reponse
        $correctAnswers = 0;
        //Tableau declarwer pour stocker les mauvaise reponse
        $wrongAnswers = [];
        //Pour recuperer le nombres le nombres total des questions
        $questionselect = Question::all();
        $totalquestions = $questionselect->count();

        foreach($request->answers as $questionId => $selectedAnswers){
            $question = Question::find($questionId);
            $answer = Answer::find($selectedAnswers);

            if($answer && $answer->is_correct){
                $correctAnswers++;
            }else{
                //Stock la question et la reponse qui on ete mal repondu
                $answerCorrect = Answer::where('question_id', $questionId)->where('is_correct', true)->first();
                $wrongAnswers[] = [
                    'question' => $question->question_text,
                    'wrong_answer' => $answer ? $answer->answer_text : 'Aucune reponse selectionnee',
                    'correct_answer' => $answerCorrect->answer_text
                ];
            }
        }
        $moys = ($correctAnswers / $totalquestions)*20;

        return view('quiz.result', compact('correctAnswers','wrongAnswers','moys','totalquestions'));
    }

    public function showHistory(){
        $histories = History::with('question')->latest()->get();
        return view('quiz.history', compact('histories'));
    }
}
