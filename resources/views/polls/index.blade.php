@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Polls</h2>
        <!-- Display a list of polls here -->
        @foreach ($polls as $poll)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $poll->title }}</h5>
                    <p class="card-text">{{ $poll->description }}</p>
                    <a href="{{ route('polls.show', $poll->slug) }}" class="btn btn-primary">View Poll</a>
                </div>
            </div>
        @endforeach
    </div>
@endsection
