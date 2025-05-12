@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Modifier le Quiz</h2>
    <form action="{{ route('quizzes.update', $quiz->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group mb-3">
            <label for="title">Titre</label>
            <input type="text" class="form-control" name="title" value="{{ $quiz->title }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" name="description" rows="3" required>{{ $quiz->description }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="category_id">Catégorie</label>
            <select name="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $category->id == $quiz->category_id ? 'selected' : '' }}>
                        {{ $category->subject }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group mb-3">
            <label for="questions">Questions du Quiz</label>
            <select name="questions[]" class="form-control" multiple required>
                @foreach($questions as $question)
                    <option value="{{ $question->id }}"
                        {{ in_array($question->id, $quiz->questions->pluck('id')->toArray()) ? 'selected' : '' }}>
                        {{ $question->label }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
