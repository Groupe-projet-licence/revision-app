<?php
namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use Illuminate\Support\Facades\DB;
use App\Models\Quiz;
use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Category;
use Inertia\Inertia;
use App\Models\Answer;
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
        return Inertia::render('Questions/QuestionCreate', [
            'quiz_id' => $quiz->id
        ]);
    }

    public function store(QuestionRequest $request, Quiz $quiz)
    {



        $question = Question::create([
            'question_text' => $request->validated('question_text'),
            'type' => $request->validated('type'),
            "quiz_id" => $quiz->id
        ]);

        foreach ($request->validated('answers') as $answer) {
            $question->answers()->create($answer);
        }
        return redirect()->route('quizzes.show', $quiz->id)->with('success', 'Question created');
    }

   public function edit($id)
{
    $question = Question::with('answers')->findOrFail($id);
    $types = ['single', 'multiple'];
    $quizzes = Quiz::all();

    return Inertia::render('Questions/EditQuestion', [
        'question' => $question,
        'types' => $types,
        'quizzes' => $quizzes,
    ]);
}


    public function update(Request $request, $id)
{
    $question = Question::findOrFail($id);

    $validated = $request->validate([
        'question_text' => 'required|string',
        'type' => 'required|in:single,multiple',
        'quiz_id' => 'required|exists:quizzes,id',
        'answers' => 'nullable|array',
        'answers.*.answer_text' => 'required|string',
        'answers.*.is_correct' => 'required|boolean',
    ]);

    $question->update([
        'question_text' => $validated['question_text'],
        'type' => $validated['type'],
        'quiz_id' => $validated['quiz_id'],
    ]);

    // Supprimer les anciennes réponses
    $question->answers()->delete();

    // Créer les nouvelles réponses
    foreach ($validated['answers'] as $answerData) {
        $question->answers()->create($answerData);
    }

    return redirect()->route('quizzes.show', $question->quiz_id)->with('success', 'Question mise à jour avec succès');
}




    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question Deleted Successfully');
    }


}
