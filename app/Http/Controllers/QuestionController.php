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
        'question_text' => 'required|string|max:255',
        'type' => 'required|in:single,multiple',
        'category_id' => 'required|exists:categories,id',
        'answers' => 'required|array|min:1',
        'answers.*.answer_text' => 'required|string',
        'answers.*.is_correct' => 'required|boolean',
    ]);

    // Création de la question
    $question = Question::create([
        'question_text' => $validated['question_text'],
        'type' => $validated['type'],
        'category_id' => $validated['category_id'],
    ]);

    // Ajout des réponses associées à la question
    foreach ($validated['answers'] as $answerData) {
        $question->answers()->create([
            'answer_text' => $answerData['answer_text'],
            'is_correct' => $answerData['is_correct'],
        ]);
    }

    return redirect()->route('questions.index')->with('success', 'Question enregistrée avec succès.');
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
