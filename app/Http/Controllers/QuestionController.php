<?php
namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
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
        $question = Question::findOrFail($id);
        return Inertia::render('Questions/QuestionCreate', [
            'quiz_id' => $question->quizzes()->id 
        ]);
    }

    public function update(QuestionRequest $request, $id)
    {
        $question = Question::findOrFail($id);

        $validated = $request->validate([
            'question_text' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'type' => 'required|in:single,multiple',
        ]);

        $question->update($validated);

        return redirect()->route('questions.index')->with('success', 'Updated question.');
    }

    public function destroy($id)
    {
        $question = Question::findOrFail($id);
        $question->delete();

        return redirect()->route('questions.index')->with('success', 'Question Deleted Successfully');
    }


}
