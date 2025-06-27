@extends('layouts.app1')

@section('content')
<div class="container">
    <h1>Liste des Quiz</h1>
    <a href="{{ route('quizzes.create') }}" class="btn btn-primary mb-3">Créer un quiz</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @forelse($quizzes as $quiz)
        <div class="card mb-2">
            <div class="card-body">
                <h5>{{ $quiz->title }}</h5>
                <p>{{ $quiz->description }}</p>
                <p><strong>Début :</strong> {{ $quiz->start_time }} | <strong>Fin :</strong> {{ $quiz->end_time }}</p>
                <a href="{{ route('quizzes.edit', $quiz) }}" class="btn btn-warning btn-sm">Modifier</a>
                <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                </form>
            </div>
        </div>
    @empty
        <p>Aucun quiz trouvé.</p>
    @endforelse
</div>
@endsection

