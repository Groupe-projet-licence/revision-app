@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails du Quiz</h2>
    <p><strong>Titre :</strong> {{ $quiz->title }}</p>
    <p><strong>Description :</strong> {{ $quiz->description }}</p>
    <p><strong>Catégorie :</strong> {{ $quiz->category->subject ?? 'Non défini' }}</p>

    <h4>Questions :</h4>
    <ul>
        @foreach($quiz->questions as $question)
            <li>{{ $question->label }}</li>
        @endforeach
    </ul>

    <a href="{{ route('quizzes.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
