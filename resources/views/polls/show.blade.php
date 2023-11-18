@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>{{ $poll->title }}</h2>
        <p>{{ $poll->description }}</p>

        <!-- Display poll questions and choices here -->
        @foreach ($poll->questions as $question)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $question->question }}</h5>
                    <ul>
                        @foreach ($question->choices as $choice)
                            <li id="choice_{{ $choice->id }}">{{ $choice->choice }} - Votes: <span id="votes_{{ $choice->id }}">{{ $choice->votes_count }}</span></li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endforeach
    </div>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        Echo.channel('poll.' + {{ $poll->id }})
            .listen('VoteUpdated', (event) => {
                // Update the votes count in real-time
                document.getElementById('votes_' + event.choiceId).innerText = event.votesCount;
            });
    </script>
@endsection
