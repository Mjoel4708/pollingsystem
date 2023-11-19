@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Polls</h2>
        @if ($polls->count() > 0)
            <ul>
                @foreach ($polls as $poll)
                    <li>
                        {{ $poll->title }}

                        <!-- Show options only to the owner -->
                        @if (auth()->check() && $poll->user_id === auth()->user()->id)
                            <a href="{{ route('polls.createQuestion', ['pollId' => $poll->id]) }}">
                                Create a Question
                            </a>
                            <a href="{{ route('polls.edit', ['pollId' => $poll->id]) }}">
                                Update
                            </a>
                            <a href="{{ route('polls.delete', ['pollId' => $poll->id]) }}">
                                Delete
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @else
            <p>No polls available.</p>
        @endif
    </div>
@endsection
