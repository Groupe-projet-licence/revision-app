<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answer;
use App\Models\Question;

class AnswerController extends Controller
{
    public function index()
    {
        $answers = Answer::with('question')->get();
        return view('answers.index', compact('answers'));
    }

    public function create()
    {
        $questions = Question::all(); // Récupère toutes les questions pour les afficher dans le formulaire
        return view('answers.create', compact('questions'));
    }

    public function store(Request $request)
{
    $request->validate([
        'question_id' => 'required|exists:questions,id',
        'answers' => 'required|array|min:1',
        'answers.*' => 'required|string',
    ]);

    foreach ($request->answers as $index => $text) {
        Answer::create([
            'question_id' => $request->question_id,
            'answer_text' => $text,
            'is_correct' => isset($request->corrects[$index]) ? true : false,
        ]);
    }

    return redirect()->back()->with('success', 'Responses successfully recorded.');
}

   public function update(Request $request, $id)
{
    $answer = Answer::findOrFail($id);

    $validated = $request->validate([
        'answer_text' => 'required|string',
        'is_correct' => 'required|boolean',
        'question_id' => 'required|exists:questions,id',
    ]);

    $question = Question::findOrFail($validated['question_id']);

    if ($question->type === 'single' && $validated['is_correct']) {
        // Vérifie s'il existe une autre réponse correcte pour cette question
        $existingCorrect = Answer::where('question_id', $question->id)
            ->where('is_correct', true)
            ->where('id', '!=', $answer->id)
            ->exists();

        if ($existingCorrect) {
            return back()->withErrors([
                'is_correct' => 'Only one correct answer is allowed for a "single" type question.'
            ])->withInput();
        }
    }

    $answer->update($validated);
    return redirect()->route('answers.index')->with('success', 'Response successfully updated');
}
    public function show($id)
    {
        $answer = Answer::with('question')->findOrFail($id);
        return view('answers.show', compact('answer'));
    }

    public function edit($id)
    {
        $answer = Answer::findOrFail($id);
        $questions = Question::all(); // Récupère toutes les questions pour les afficher dans le formulaire
        return view('answers.edit', compact('answer', 'questions'));
    }

        public function destroy($id)
    {
        $answer = Answer::findOrFail($id);
        $answer->delete();
        return redirect()->route('answers.index')->with('success', 'Reply successfully deleted');
    }
}
