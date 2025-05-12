
@extends('layouts.app1')

@section('content')
<div class="container">
    <h2>Modifier la question</h2>

    <form action="{{ route('questions.update', $question->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label for="question_text" class="form-label">Intitulé</label>
            <input type="text" class="form-control" name="question_text" value="{{ $question->question_text }}" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-control" name="type" required>
                <option value="single" {{ $question->type == 'single' ? 'selected' : '' }}>Simple</option>
                <option value="multiple" {{ $question->type == 'multiple' ? 'selected' : '' }}>Multiple</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Catégorie</label>
            <select class="form-control" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $question->category_id == $category->id ? 'selected' : '' }}>
                        {{ $category->subject }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
