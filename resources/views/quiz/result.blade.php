<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultal du quiz</title>
</head>
<body>
    <div class="container">
        <h1>Voici les resultats du quiz</h1>
        <h2>Vous avez repondu a {{ $correctAnswers }} sur {{ $totalquestions }}</h2>
        <h2>Votre moyenne est {{ $moys }}</h2>
    </div>

    @if (count($wrongAnswers) > 0)
                <h2>Question incorrect avec correction</h2>
                <div class="resultcontainer">
                    <table class="result_tab" border="1">
                        <tr>
                            <th>Question</th>
                            <th>Votre réponse</th>
                            <th>Bonne réponse</th>
                        </tr>
                        @php
                            $i=1;
                        @endphp
                        @foreach ($wrongAnswers as $wrong)
                            
                        <tr>
                            <td>{{ $i }}) {{ $wrong['question'] }} </td>
                            <td>{{ $wrong['wrong_answer'] }}</td>
                            <td>{{ $wrong['correct_answer'] }}</td>
                        </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </table>
                </div>         
    @endif

    <h3><a href="{{ route('quiz.categories') }}">Recommencer le quiz</a></h3>
    <h3><a href="{{ route('quiz.history') }}">Voir historique</a></h3>
</body>
</html>