<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;
use Inertia\Inertia;

class QuestionController extends Controller
{
    public function index()
{
    $questions = Question::with('answers', 'category')->latest()->get();
    return view('questions.index', compact('questions'));
}


    public function create()
    {
        return Inertia::render('Quizzes/QuestionCreate');
    }

    public function store(Request $request)
    {
        $request->merge([
            'question_text' => $request->question_text == '<p><br></p>' ? '' : $request->question_text
        ]);
        
        $validated = $request->validate([
            'question_text' => 'required|string',
            'type' => 'required|in:single,multiple',
            'answers' => 'required|array|min:2',
            'answers.*.answer_text' => 'required|string',
            'answers.*.is_correct' => 'required|boolean',
        ]);

        $question = Question::create([
            'question_text' => $validated['question_text'],
            'type' => $validated['type'],
        ]);

        foreach ($validated['answers'] as $answer) {
            $question->answers()->create($answer);
        }
        return redirect()->back()->with('success', 'Question ajoutée.');
    }

    // public function show()
    // {
    //     $questions = Question::all(); // ou filtrer selon besoin
    //     return view('questions.show', compact('questions'));
    // }

    public function edit($id)
    {
        $question = Question::findOrFail($id);
        $categories = Category::all();
        $types = ['single', 'multiple'];
        return view('questions.edit', compact('question', 'categories', 'types'));
    }

    public function update(Request $request, $id)
    {
        $question = Question::findOrFail($id);

        $validated = $request->validate([
            'question_text' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:single,multiple',
        ]);

        $question->update($validated);

        return redirect()->route('questions.index')->with('success', 'Question mise à jour');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Supprimée avec succès');
    }


}
