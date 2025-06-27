@extends('layouts.app1')

@section('content')
<div class="container">
    <h2>{{ $quiz->title }}</h2>
    <form action="{{ route('histories.submit', $quiz->id) }}" method="POST">
        @csrf
        <input type="hidden" name="history_id" value="{{ $history->id }}">
        @foreach($quiz->questions as $question)
            <div class="mb-3">
                <h5>{{ $question->content }}</h5>
                @if($question->type === 'single')
                    @foreach($question->answers as $answer)
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="question_{{ $question->id }}" value="{{ $answer->id }}">
                            <label class="form-check-label">{{ $answer->content }}</label>
                        </div>
                    @endforeach
                @elseif($question->type === 'multiple')
                    @foreach($question->answers as $answer)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="question_{{ $question->id }}[]" value="{{ $answer->id }}">
                            <label class="form-check-label">{{ $answer->content }}</label>
                        </div>
                    @endforeach
                @endif
            </div>
        @endforeach
        <button type="submit" class="btn btn-success">Soumettre</button>
    </form>
</div>
@endsection
