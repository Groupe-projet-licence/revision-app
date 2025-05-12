@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Historique des Quiz</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Quiz</th>
                <th>Score</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($histories as $history)
                <tr>
                    <td>{{ $history->id }}</td>
                    <td>{{ $history->user->name }}</td>
                    <td>{{ $history->quiz->title }}</td>
                    <td>{{ $history->score }}</td>
                    <td>{{ $history->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('histories.show', $history->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <form action="{{ route('histories.destroy', $history->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
