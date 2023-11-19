<!-- resources/views/votes/component.blade.php -->

<ul>
    @foreach ($choices as $choice)
        <li>
            Choice: {{ $choice->choice }} - Votes: {{ $choice->votes->count() }}

            @if (auth()->check())
                @php
                    $userVote = $choice->votes->where('user_id', auth()->user()->id)->first();
                @endphp

                @if ($userVote)
                    <!-- Show Unvote button -->
                    <form method="post" action="{{ route('votes.unvote', ['choiceId' => $choice->id]) }}">
                        @csrf
                        @method('delete')
                        <button type="submit">Unvote</button>
                    </form>
                @else
                    <!-- Show Vote button -->
                    <form method="post" action="{{ route('votes.vote', ['choiceId' => $choice->id]) }}">
                        @csrf
                        <button type="submit">Vote</button>
                    </form>
                @endif
            @endif
        </li>
    @endforeach
</ul>
<!-- resources/views/votes/index.blade.php -->
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    Echo.channel('poll.' + {{ $pollId }})
        .listen('VoteCasted', (e) => {
            console.log(e);
            alert('A vote was casted on ' + e.choice.choice);
        });
        

</script>
