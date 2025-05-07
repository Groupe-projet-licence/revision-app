<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selectionner la matiere</title>
</head>
<body>
    <h1>Chossisez UV sur le quelle vous voulez etre evaluer</h1>
    <ul>
        @foreach ($categories as $category)
            <li><a href="{{ route('quiz.questions', $category->id) }}">{{ $category->subject }}</a></li>
        @endforeach
    </ul>
</body>
</html>