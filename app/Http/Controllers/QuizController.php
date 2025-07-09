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
    public function index(Request $request)
    {
        $myQuizzes = Quiz::where('user_id', Auth::id())->latest()->get();

        $otherQuizzes = Quiz::with('category', 'user')
            ->where('user_id', '!=', Auth::id())
            ->latest()
            ->paginate(6); // ajuste le nombre par page

        return Inertia::render('Quizzes/QuizzesIndex', [
            'myQuizzes' => $myQuizzes,
            'otherQuizzes' => $otherQuizzes
        ]);
    }



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
        return back()->with('success', 'Quiz created successfully.');
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

        return redirect()->route('quizzes.index')->with('success', 'Quiz successfully updated.');
    }

    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Quiz successfully deleted.');
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.answers');
        return Inertia::render('Quizzes/ShowQuiz', compact('quiz'));
    }
}
