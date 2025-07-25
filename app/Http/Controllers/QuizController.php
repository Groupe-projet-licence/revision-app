<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Inertia\Inertia;
use App\Models\Category;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
 use Illuminate\Support\Facades\Mail;
use App\Mail\QuizShared;


class QuizController extends Controller
{
    public function index(Request $request)
{
    $myQuizzes = Quiz::where('user_id', Auth::id())
        ->latest()
        ->get()
        ->map(function ($quiz) {
            $quiz->can_edit = true;
            return $quiz;
        });

    $otherQuizzes = Quiz::with('category', 'user')
        ->where('user_id', '!=', Auth::id())
        ->latest()
        ->paginate(6);

    // ajoute can_edit = false pour les autres quiz
    $otherQuizzes->getCollection()->transform(function ($quiz) {
        $quiz->can_edit = false;
        return $quiz;
    });

    return Inertia::render('Quizzes/QuizzesIndex', [
        'myQuizzes' => $myQuizzes,
        'otherQuizzes' => $otherQuizzes,
        'auth' => ['user' => Auth::user()
        ]
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
        return Inertia::render('Quizzes/EditQuiz', [
            'quiz' => $quiz
        ]);
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

        return redirect()->route('quizzes.index')->with('success', 'Quiz updated successfully.');
    }

    public function share(Request $request, Quiz $quiz)
    {
        $request->validate([
             'email' => 'required|email',
            ]);


             // Envoi du mail
            Mail::to($request->email)->send(new QuizShared($quiz, Auth::user()));
             return back()->with('success', 'The quiz has been shared sucessfully via email.');
    }


    function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Quiz deleted successfully.');
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions.answers');
        return Inertia::render('Quizzes/ShowQuiz', compact('quiz'));
    }
}
