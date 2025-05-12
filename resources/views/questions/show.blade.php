@extends('layouts.app1')

@section('content')
<div class="container">
    <h2>Détail de la Question</h2>

    <p><strong>Intitulé :</strong> {{ $question->question_text }}</p>
    <p><strong>Type :</strong> {{ $question->type }}</p>
    <p><strong>Catégorie :</strong> {{ $question->category->subject ?? 'N/A' }}</p>

    <h4>Réponses possibles :</h4>
    <ul>
        @foreach($question->answers as $answer)
            <li>{{ $answer->answer_text }} @if($answer->is_correct) (correcte) @endif</li>
        @endforeach
    </ul>

    <a href="{{ route('questions.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
