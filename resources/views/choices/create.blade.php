@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create a Poll - Step 3</h2>
        <form method="post" action="{{ route('choices.store') }}">
            @csrf
            <div class="form-group">
                <label for="choice">Choice:</label>
                <input type="text" class="form-control" id="choice" name="choice" required>
            </div>

            <button type="submit" class="btn btn-primary">Create Poll</button>
        </form>
    </div>
@endsection