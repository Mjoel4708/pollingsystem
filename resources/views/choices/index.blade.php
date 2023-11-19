@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Choices for Question: {{ $question->question }}</h2>

        <!-- Show options only to the owner -->
        @if (auth()->check() && $question->poll->user_id === auth()->user()->id)
            <a href="{{ route('choices.create', ['pollId' => $question->poll->id, 'questionId' => $question->id]) }}">
                Create a Choice
            </a>
        @endif

        <!-- Display choices related to the question -->
        <ul>
            @foreach ($question->choices as $choice)
                <li>
                    {{ $choice->choice }}

                    <!-- Show options only to the owner -->
                    @if (auth()->check() && $question->poll->user_id === auth()->user()->id)
                        <a href="{{ route('choices.edit', ['pollId' => $question->poll->id, 'questionId' => $question->id, 'choiceId' => $choice->id]) }}">
                            Update
                        </a>
                        <a href="{{ route('choices.delete', ['pollId' => $question->poll->id, 'questionId' => $question->id, 'choiceId' => $choice->id]) }}">
                            Delete
                        </a>
                    @endif
                </li>
            @endforeach
        </ul>

        <!-- Include the votes component -->
        @include('votes.index')
    </div>
@endsection
