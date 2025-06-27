@extends('layouts.app1')

@section('content')
<div class="container">
    <h2>Liste des Catégories</h2>
    <a href="{{ route('categories.create') }}" class="btn btn-primary mb-3">Ajouter une Catégorie</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Sujet</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->subject }}</td>
                    <td>
                        <a href="{{ route('categories.show', $category->id) }}" class="btn btn-info btn-sm">Voir</a>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
