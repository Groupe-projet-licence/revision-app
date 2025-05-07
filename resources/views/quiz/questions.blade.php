<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Questions</title>
</head>
<body>
    <h1>Repondez au question</h1>
    <form action="{{ route('quiz.submit') }}" method="post">
        @php
            $i=1
        @endphp
        @csrf
        @foreach ($questions as $question)
            <strong>{{ $i }}){{ $question->question_text }}</strong>
            @foreach ($question->answers as $answer)
                <label for="">
                    <input type="checkbox" name="answers[{{ $question->id }}]" value="{{ $answer->id }}">{{ $answer->answer_text }}
                </label>
                    <input type="checkbox" name="answers[{{ $question->id }}]" value="{{ $answer->id }}">
            @endforeach
        @endforeach

        <button type="submit">Finish</button>
    </form>

</body>
</html>