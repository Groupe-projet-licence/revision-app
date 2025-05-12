<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        return dd(Quiz::with('questions')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array',
            'questions.*' => 'exists:questions,id'
        ]);

        $quiz = Quiz::create($validated);
        $quiz->questions()->sync($validated['questions']);

        return $quiz->load('questions');
    }

    public function show($id)
    {
        return Quiz::with('questions')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $quiz = Quiz::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'questions' => 'required|array',
            'questions.*' => 'exists:questions,id'
        ]);

        $quiz->update($validated);
        $quiz->questions()->sync($validated['questions']);

        return $quiz->load('questions');
    }

    public function destroy($id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->questions()->detach();
        $quiz->delete();
        return response()->json(['message' => 'Quiz supprimé avec succès']);
    }
}
