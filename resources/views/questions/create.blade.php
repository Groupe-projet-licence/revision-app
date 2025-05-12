@extends('layouts.app1')

@section('content')
<div class="container">
    <h2>Ajouter une nouvelle question</h2>

    <form action="{{ route('questions.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="question_text" class="form-label">Intitulé</label>
            <input type="text" class="form-control" name="question_text" required>
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Type</label>
            <select class="form-control" name="type" required>
                <option value="single">Simple</option>
                <option value="multiple">Multiple</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">Catégorie</label>
            <select class="form-control" name="category_id" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->subject }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection
