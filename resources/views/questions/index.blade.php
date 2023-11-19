@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Questions for Poll: {{ $poll->title }}</h2>

        <!-- Show options only to the owner -->
        @if (auth()->check() && $poll->user_id === auth()->user()->id)
            <a href="{{ route('choices.create', ['pollId' => $poll->id, 'questionId' => $question->id]) }}">
                Create a Choice
            </a>
        @endif
        @include('choices.index')
    </div>
@endsection
