@extends('layouts.app1')

@section('content')
<div class="container">
    <h2>Créer une Catégorie</h2>
    <form action="{{ route('categories.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="subject">Sujet</label>
            <input type="text" name="subject" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection
