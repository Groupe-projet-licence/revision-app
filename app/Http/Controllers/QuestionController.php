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
        return redirect()->route('quizzes.show', $quiz->id)->with('success', 'Question added successfully.');
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


    public function update(QuestionRequest $request, $id)
    {
        $question = Question::findOrFail($id);


        $question->update([
            'question_text' => $request->validated('question_text'),
            'type' => $request->validated('type')
        ]);

        // Supprimer les anciennes réponses
        $question->answers()->delete();

        // Créer les nouvelles réponses
        foreach ($request->validated('answers') as $answer) {
            $question->answers()->create($answer);
        }

        return redirect()->route('quizzes.show', $question->quiz_id)->with('success', 'Question updated successfully.');
    }




    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question Deleted Successfully');
    }


}
