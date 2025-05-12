@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Liste des Quiz</h2>
    <a href="{{ route('quizzes.create') }}" class="btn btn-primary mb-3">Créer un nouveau Quiz</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Description</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($quizzes as $quiz)
                <tr>
                    <td>{{ $quiz->id }}</td>
                    <td>{{ $quiz->title }}</td>
                    <td>{{ $quiz->description }}</td>
                    <td>{{ $quiz->category->subject ?? 'Non défini' }}</td>
                    <td>
                        <a href="{{ route('quizzes.show', $quiz->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('quizzes.edit', $quiz->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('quizzes.destroy', $quiz->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce quiz ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
