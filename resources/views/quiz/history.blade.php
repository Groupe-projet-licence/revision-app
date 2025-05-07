<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Historique</title>
</head>
<body>
<h1>Historique :</h1>
    <ul>
        @foreach($histories as $history)
            <li>
                <strong>{{ $history->question->question_text }}</strong><br>
                Vos réponses :
                <ul>
                @foreach($history->user_answers as $answerId)
                    <li>{{ \App\Models\Answer::find($answerId)->answer_text ?? 'Réponse supprimée' }}</li>
                @endforeach
                </ul>
                @if($history->is_correct)
                    ✅ Correct
                @else
                    ❌ Incorrect
                @endif
            </li>
        @endforeach
    </ul>
</body>
</html>