@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Poll: {{ $poll->title }}</h2>

        <!-- Show options only to the owner -->
        @if (auth()->check() && $poll->user_id === auth()->user()->id)
            <a href="{{ route('questions.create', ['pollId' => $poll->id]) }}">
                Create a Question
            </a>
            <a href="{{ route('polls.edit', ['pollId' => $poll->id]) }}">
                Update
            </a>
            <a href="{{ route('polls.delete', ['pollId' => $poll->id]) }}">
                Delete
            </a>
        @endif

        <!-- Display poll details -->
        <p>{{ $poll->description }}</p>

        <!-- Display questions related to the poll -->
        @include('questions.index')
    </div>
@endsection
