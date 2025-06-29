<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class QuizController extends Controller
{
    public function index()
    {
        $myQuizzes = Quiz::where('user_id', Auth::id())->latest()->get();
        $otherQuizzes = Quiz::with('user')->where('user_id', '!=', Auth::id())->latest()->get();

        return Inertia::render('Quizzes/QuizzesIndex', [
            'myQuizzes' => $myQuizzes,
            'otherQuizzes' => $otherQuizzes
        ]);
        /*$quizzes = Quiz::with('category')->get();

         return Inertia::render('Quizzes/QuizzesIndex', [
             'quizzes' => $quizzes
         ]);*/
    }

    // public function create()
    // {
    //     $categories = Category::all();
    //     $questions = Question::all();
    //     return view('quizzes.create', compact('categories', 'questions'));
    // }

    // public function create()
    // {
    //     return Inertia::render('Quizzes/Questions/QuestionsIndex', [
    //         'categories' => Category::all(),
    //         'questions' => Question::all()
    //     ]);
    // }

    public function store(Request $request)
    {
        $request->merge([
            'description' => $request->input('description') == '' ? 'Topic without description' : $request->input('description')
        ]);
        $request->validate([
            'title' => 'required|string|max:100',
            'description' => 'nullable|string|max:100',
        ]);

        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
            'user_id' => Auth::id()
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz créé avec succès.');
    }

    public function edit(Quiz $quiz)
    {
        $categories = Category::all();
        $questions = Question::all();
        return view('quizzes.edit', compact('quiz', 'categories', 'questions'));
    }

    public function update(Request $request, Quiz $quiz)
    {
        $request->merge([
            'description' => $request->input('description') == '' ? 'Topic without description' : $request->input('description')
        ]);
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            //'questions' => 'required|array',
            //'questions.*' => 'exists:questions,id',
        ]);

        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect()->route('quizzes.index')->with('success', 'Quiz mis à jour avec succès.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Quiz supprimé avec succès.');
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.answers');
        return Inertia::render('Quizzes/ShowQuiz', compact('quiz'));
    }
}
