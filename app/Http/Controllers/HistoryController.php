<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;

class HistoryController extends Controller
{
    public function index()
    {
        return History::with('question')->latest()->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'user_answers' => 'required|array',
            'user_answers.*' => 'integer|exists:answers,id',
            'is_correct' => 'required|boolean',
        ]);

        return History::create($validated);
    }

    public function show($id)
    {
        return History::with('question')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $history = History::findOrFail($id);

        $validated = $request->validate([
            'question_id' => 'required|exists:questions,id',
            'user_answers' => 'required|array',
            'user_answers.*' => 'integer|exists:answers,id',
            'is_correct' => 'required|boolean',
        ]);

        $history->update($validated);
        return $history;
    }

    public function destroy($id)
    {
        $history = History::findOrFail($id);
        $history->delete();
        return response()->json(['message' => 'Historique supprimé avec succès']);
    }
}
