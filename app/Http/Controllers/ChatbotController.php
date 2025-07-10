<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
public function ask(Request $request)
{
$question = $request->input('question');
    // Vérifie si la question concerne l'application
    $keywords = ['fiche', 'quiz', 'révision', 'easylearning', 'tableau de bord', 'utilisateur'];
    $isRelevant = collect($keywords)->contains(function ($keyword) use ($question) {
        return stripos($question, $keyword) !== false;
    });

    if (! $isRelevant) {
        return response()->json([
            'answer' => "❌ Cette question ne concerne pas notre application. Pose-moi une question à propos d'EasyLearning."
        ]);
    }

    $response = Http::withToken(env('OPENAI_API_KEY'))
        ->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                [
                    'role' => 'system',
                    'content' => 'Tu es un assistant virtuel qui ne répond qu’aux questions concernant l’application EasyLearning (création de fiches, quiz, révision, tableau de bord, etc).'
                ],
                [
                    'role' => 'user',
                    'content' => $question
                ]
            ],
        ]);

    return response()->json([
        'answer' => $response->json()['choices'][0]['message']['content']
    ]);
}
}