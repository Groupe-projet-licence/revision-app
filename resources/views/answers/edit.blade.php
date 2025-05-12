@extends('layouts.app1')


@section('content')
<div class="container">
    <h2>Modifier une réponse</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form method="POST" action="{{ route('answers.update', $answer->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="question_id" class="form-label">Question</label>
            <select name="question_id" id="question_id" class="form-select" required onchange="updateCorrectInput()">
                @foreach($questions as $question)
                    <option value="{{ $question->id }}"
                        data-type="{{ $question->type }}"
                        {{ $answer->question_id == $question->id ? 'selected' : '' }}>
                        {{ $question->question_text }} ({{ ucfirst($question->type) }})
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="answer_text" class="form-label">Texte de la réponse</label>
            <input type="text" name="answer_text" class="form-control" required value="{{ old('answer_text', $answer->answer_text) }}">
        </div>

        <div class="mb-3" id="is_correct_container">
            <!-- Champ généré dynamiquement -->
        </div>

        <button type="submit" class="btn btn-success">Mettre à jour</button>
    </form>
</div>

<script>
    function updateCorrectInput() {
        const select = document.getElementById('question_id');
        const selectedOption = select.options[select.selectedIndex];
        const questionType = selectedOption.dataset.type;
        const container = document.getElementById('is_correct_container');
        container.innerHTML = '';

        const isCorrect = {{ $answer->is_correct ? 'true' : 'false' }};

        if (questionType === 'single') {
            container.innerHTML = `
                <label class="form-label">Bonne réponse ?</label>
                <div>
                    <label><input type="radio" name="is_correct" value="1" ${isCorrect ? 'checked' : ''} required> Oui</label>
                    <label class="ms-3"><input type="radio" name="is_correct" value="0" ${!isCorrect ? 'checked' : ''}> Non</label>
                </div>
            `;
        } else if (questionType === 'multiple') {
            container.innerHTML = `
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="is_correct" value="1" id="is_correct" ${isCorrect ? 'checked' : ''}>
                    <label class="form-check-label" for="is_correct">Bonne réponse</label>
                </div>
            `;
        }
    }

    document.addEventListener('DOMContentLoaded', updateCorrectInput);
</script>
@endsection
