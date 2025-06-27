@extends('layouts.app1')


@section('content')
<div class="container">
    <h2>Historique des évaluations</h2>

    @if($histories->count() > 0)
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>Quiz</th>
                    <th>Date</th>
                    <th>Score</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($histories as $history)
                    <tr>
                        <td>{{ $history->quiz->title }}</td>
                        <td>{{ $history->created_at->format('d/m/Y H:i') }}</td>
                        <td>{{ $history->score }} / 100</td>
                        <td>
                            <a href="{{ route('histories.result', $history->id) }}" class="btn btn-primary btn-sm">Voir le résultat</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun historique trouvé pour le moment.</p>
    @endif
</div>
@endsection
