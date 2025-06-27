@extends('layouts.app1')

@section('content')
<div class="container">
    <h2>Créer un nouveau Quiz</h2>
    <form action="{{ route('quizzes.store') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="title">Titre</label>
            <input type="text" class="form-control" name="title" required>
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="start_time" class="form-label">Date de début</label>
            <input type="datetime-local" name="start_time" class="form-control">
        </div>

        <div class="mb-3">
            <label for="end_time" class="form-label">Date de fin</label>
            <input type="datetime-local" name="end_time" class="form-control">
        </div>

        <div class="form-group mb-3">
            <label for="category_id">Catégorie</label>
            <select name="category_id" class="form-control" required>
                <option value="">Sélectionner une catégorie</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->subject }}</option>
                @endforeach
            </select>
        </div>


        <div class="form-group mb-3">
            <label for="questions">Sélectionner les questions</label>
            <select name="questions[]" class="form-control" multiple required>
                 @foreach($questions as $question)
                 <option value="{{ $question->id }}">{{ $question->label }}</option>
                 @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Créer</button>
     </form>
@endsection
