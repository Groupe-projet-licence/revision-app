<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;

class QuestionController extends Controller
{
    public function index()
{
    $questions = Question::with('answers', 'category')->latest()->get();
    return view('questions.index', compact('questions'));
}


    public function create()
    {
        $categories = Category::all();
        $types = ['single', 'multiple']; // Type ENUM direct
        return view('questions.create', compact('categories', 'types'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'question_text' => 'required|string',
        'type' => 'required|in:single,multiple',
        'answers' => 'required|array|min:1',
        'answers.*.answers_text' => 'required|string',
        'answers.*.is_correct' => 'required|boolean',
    ]);

    $question = Question::create([
        'content' => $validated['question'],
        'type' => $validated['type'],
    ]);

    foreach ($validated['options'] as $answer) {
        $question->answers()->create($answer);
    }

    return redirect()->back()->with('success', 'Question ajoutée.');
}

    public function show()
    {
        $questions = Question::all(); // ou filtrer selon besoin
        return view('questions.show', compact('questions'));
    }

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
