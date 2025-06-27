@extends('layouts.app1')

@section('content')
<div class="container">
    <h2>Détails de la Catégorie</h2>
    <p><strong>ID :</strong> {{ $category->id }}</p>
    <p><strong>Sujet :</strong> {{ $category->subject }}</p>
    <a href="{{ route('categories.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
