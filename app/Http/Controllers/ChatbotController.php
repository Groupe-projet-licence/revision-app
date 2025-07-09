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
        $keywords = ['fiche', 'quiz', 'révision', 'tableau de bord', 'easylearning', 'application'];
        $isRelevant = false;

        foreach ($keywords as $keyword) {
            if (stripos($question, $keyword) !== false) {
                $isRelevant = true;
                break;
            }
        }

        if (! $isRelevant) {
            return response()->json([
                'answer' => "❌ Cette question ne concerne pas notre application. Pose-moi une question à propos d'EasyLearning."
            ]);
        }

        $response = Http::withHeaders([
            'Authorization' => 'Bearer '.env('OPENAI_API_KEY'),
        ])->post('https://api.openai.com/v1/chat/completions', [
            'model' => 'gpt-3.5-turbo',
            'messages' => [
                ['role' => 'system', 'content' => 'Tu es un assistant virtuel qui répond uniquement aux questions concernant une application de révision nommée EasyLearning.'],
                ['role' => 'user', 'content' => $question],
            ],
        ]);

        return response()->json([
            'answer' => $response['choices'][0]['message']['content']
        ]);
    }
}
