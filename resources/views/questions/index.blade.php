@extends('layouts.app1')

@section('content')
<div class="container">
    <h2>Liste des Questions</h2>
    <a href="{{ route('questions.create') }}" class="btn btn-primary mb-3">Ajouter une Question</a>

    @if($questions->isEmpty())
        <p>Aucune question trouvée.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Intitulé</th>
                    <th>Catégorie</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($questions as $question)
                    <tr>
                        <td>{{ $question->question_text }}</td>
                        <td>{{ $question->category->subject ?? 'N/A' }}</td>
                        <td>{{ $question->type == 'single' ? 'Simple' : 'Multiple' }}</td>
                        <td>
                            <a href="{{ route('questions.show', $question->id) }}" class="btn btn-info btn-sm">Voir</a>
                            <a href="{{ route('questions.edit', $question->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('questions.destroy', $question->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette question ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
