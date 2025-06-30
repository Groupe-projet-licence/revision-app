<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;


class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('category')->get();

        return Inertia::render('Quizzes/QuizzesIndex', compact('quizzes'));
    }

    // public function create()
    // {
    //     $categories = Category::all();
    //     $questions = Question::all();
    //     return view('quizzes.create', compact('categories', 'questions'));
    // }

    public function create()
    {
        return Inertia::render('Quizzes/Questions/QuestionsIndex',[
            'categories'=>Category::all(),
            'questions'=>Question::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $quiz = Quiz::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);
        dd($quiz);  

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
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'start_time' => 'nullable|date',
            'end_time' => 'nullable|date|after_or_equal:start_time',
            'category_id' => 'required|exists:categories,id',
            'questions' => 'required|array',
            'questions.*' => 'exists:questions,id',
        ]);

        $quiz->update([
            'title' => $request->title,
            'description' => $request->description,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'category_id' => $request->category_id,
        ]);

        $quiz->questions()->sync($request->questions);

        return redirect()->route('quizzes.index')->with('success', 'Quiz mis à jour avec succès.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->questions()->detach(); // détacher les relations avant suppression
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Quiz supprimé avec succès.');
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.answers');
        return view('quizzes.show', compact('quiz'));
    }
}
