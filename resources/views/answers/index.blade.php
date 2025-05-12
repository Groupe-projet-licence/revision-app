@extends('layouts.app1')

@section('content')
<div class="container">
    <h2>Liste des réponses</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('answers.create') }}" class="btn btn-primary mb-3">Ajouter une réponse</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Texte de la réponse</th>
                <th>Correcte</th>
                <th>Question</th>
                <th>Type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($answers as $answer)
                <tr>
                    <td>{{ $answer->id }}</td>
                    <td>{{ $answer->answer_text }}</td>
                    <td>
                        @if($answer->is_correct)
                            <span class="badge bg-success">Oui</span>
                        @else
                            <span class="badge bg-danger">Non</span>
                        @endif
                    </td>
                    <td>{{ $answer->question->question_text }}</td>
                    <td><span class="badge bg-info">{{ ucfirst($answer->question->type) }}</span></td>
                    <td>
                        <a href="{{ route('answers.show', $answer->id) }}" class="btn btn-sm btn-secondary">Voir</a>
                        <a href="{{ route('answers.edit', $answer->id) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('answers.destroy', $answer->id) }}" method="POST" class="d-inline"
                              onsubmit="return confirm('Confirmer la suppression ?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
