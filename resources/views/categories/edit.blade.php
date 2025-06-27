@extends('layouts.app1')

@section('content')
<div class="container">
    <h2>Modifier la Catégorie</h2>
    <form action="{{ route('categories.update', $category->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="form-group">
            <label for="subject">Sujet</label>
            <input type="text" name="subject" class="form-control" value="{{ $category->subject }}" required>
        </div>
        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
</div>
@endsection
