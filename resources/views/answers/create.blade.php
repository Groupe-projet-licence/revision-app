@extends('layouts.app1')


@section('content')
<div class="container">
    <h2>Ajouter une réponse</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif
<form action="{{ route('answers.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Question</label>
        <select name="question_id" class="form-control" required>
            @foreach ($questions as $question)
                <option value="{{ $question->id }}">{{ $question->question_text }}</option>
            @endforeach
        </select>
    </div>

    <div id="answers">
        <div class="form-group">
            <label>Réponse</label>
            <input type="text" name="answers[]" class="form-control" required>
            <input type="checkbox" name="corrects[]" value="0"> Correcte
        </div>
    </div>

    <button type="button" onclick="addAnswer()">+ Ajouter une réponse</button>
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>

<script>
function addAnswer() {
    const div = document.createElement('div');
    div.innerHTML = `
        <div class="form-group mt-2">
            <label>Réponse</label>
            <input type="text" name="answers[]" class="form-control" required>
            <input type="checkbox" name="corrects[]" value="0"> Correcte
        </div>`;
    document.getElementById('answers').appendChild(div);
}
</script>
</div>

<script>
    function updateCorrectInput() {
        const select = document.getElementById('question_id');
        const selectedOption = select.options[select.selectedIndex];
        const questionType = selectedOption.dataset.type;

        const container = document.getElementById('is_correct_container');
        container.innerHTML = '';

        if (questionType === 'single') {
            container.innerHTML = `
                <label class="form-label">Bonne réponse ?</label>
                <div>
                    <label><input type="radio" name="is_correct" value="1" required> Oui</label>
                    <label class="ms-3"><input type="radio" name="is_correct" value="0"> Non</label>
                </div>
            `;
        } else if (questionType === 'multiple') {
            container.innerHTML = `
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_correct" value="1" id="is_correct">
                    <label class="form-check-label" for="is_correct">Bonne réponse</label>
                </div>
            `;
        }
    }

    document.addEventListener('DOMContentLoaded', updateCorrectInput);
</script>
@endsection
