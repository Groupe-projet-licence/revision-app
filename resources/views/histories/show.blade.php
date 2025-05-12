@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Détails de l'Historique</h2>
    <p><strong>ID :</strong> {{ $history->id }}</p>
    <p><strong>Utilisateur :</strong> {{ $history->user->name }}</p>
    <p><strong>Quiz :</strong> {{ $history->quiz->title }}</p>
    <p><strong>Score :</strong> {{ $history->score }}</p>
    <p><strong>Date :</strong> {{ $history->created_at->format('d/m/Y H:i') }}</p>
    <a href="{{ route('histories.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
