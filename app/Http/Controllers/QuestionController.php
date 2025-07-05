<?php
namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;
use Inertia\Inertia;
use Ramsey\Uuid\Type\Integer;

class QuestionController extends Controller
{
    public function index()
    {
        $questions = Question::with('quizzes')->get();
        return Inertia::render('Questions/Index', [
            'questions' => $questions
        ]);
    }


    public function create(Quiz $quiz)
    {
        return Inertia::render('Questions/QuestionCreate' ,[
            'quiz_id'=>$quiz->id
        ]);
    }

    public function store(Request $request, Quiz $quiz)
    {
        $request->merge([
            'question_text' => $request->question_text == '<p><br></p>' ? '' : $request->question_text,
        ]);
        $answers= $request->answers;
        foreach ($answers as $index => $answer) {
            $answers[$index]['answer_text'] = $answer['answer_text'] == '<p><br></p>' ? '' : $answer['answer_text'];
        }
        $request->merge([
            'answers' => $answers
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
            "quiz_id" => $quiz->id
        ]);

        foreach ($validated['answers'] as $answer) {
            $question->answers()->create($answer);
        }
        return redirect()->route('quizzes.show', $quiz->id);
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
