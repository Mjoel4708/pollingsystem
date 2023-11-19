@section('content')
    <div class="container">
        <h2>Create a Poll - Step 1</h2>
        <form method="post" action="{{ route('polls.store') }}">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>

            <button type="submit" class="btn btn-success">Next</button>
        </form>
    </div>
@endsection