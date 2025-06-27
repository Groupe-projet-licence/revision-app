@extends('layouts.app1')

@section('content')
<div class="container">
    <h2>Résultat de l'évaluation</h2>
    <p><strong>Score :</strong> {{ $history->score }}/100</p>
    <h4>Détail :</h4>
    <ul class="list-group">
        @foreach(json_decode($history->correction, true) as $questionId => $status)
            <li class="list-group-item">
                Question #{{ $questionId }} : {{ ucfirst($status) }}
            </li>
        @endforeach
    </ul>
</div>
@endsection
