@extends('layouts.app1')

@section('content')
<div class="container">
    <h2>Détail de la réponse #{{ $answer->id }}</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Texte :</h5>
            <p class="card-text">{{ $answer->answer_text }}</p>

            <h5 class="card-title">Correcte :</h5>
            <p>
                @if($answer->is_correct)
                    <span class="badge bg-success">Oui</span>
                @else
                    <span class="badge bg-danger">Non</span>
                @endif
            </p>

            <h5 class="card-title">Question associée :</h5>
            <p>{{ $answer->question->question_text }}</p>

            <h5 class="card-title">Type de question :</h5>
            <p><span class="badge bg-info">{{ ucfirst($answer->question->type) }}</span></p>
        </div>
    </div>

    <a href="{{ route('answers.index') }}" class="btn btn-secondary mt-3">Retour à la liste</a>
@endsection
