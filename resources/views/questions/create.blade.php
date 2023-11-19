@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create a Poll - Step 2</h2>
        <form method="post" action="{{ route('questions.store') }}">
            @csrf
            <div class="form-group">
                <label for="question">Question:</label>
                <input type="text" class="form-control" id="question" name="question" required>
            </div>

            <button type="submit" class="btn btn-success">Next</button>
        </form>
    </div>
@endsection
