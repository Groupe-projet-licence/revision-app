@extends('layouts.app')

@section('content')
    <h1>Créer une fiche de révision</h1>

    @if (session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <form method="POST" action="/sheets">
        @csrf

        <label>Titre :</label>
        <input type="text" name="title" value="{{ old('title') }}">
        @error('title') <div>{{ $message }}</div> @enderror

        <label>Contenu :</label>
        <textarea name="content">{{ old('content') }}</textarea>
        @error('content') <div>{{ $message }}</div> @enderror

        <button type="submit">Créer</button>
    </form>
@endsection
