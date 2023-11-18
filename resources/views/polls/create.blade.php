@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Create a Poll - Step 1</h2>
        <form id="createPollForm" method="post" action="{{ route('polls.store') }}">
            @csrf
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>

            <button type="button" class="btn btn-success" onclick="nextStep()">Next</button>
        </form>

        <div id="step2" style="display: none;">
            <h2>Create a Poll - Step 2</h2>
            <form id="createQuestionForm" method="post" action="{{ route('questions.store') }}">
                @csrf
                <div class="form-group">
                    <label for="question">Question:</label>
                    <input type="text" class="form-control" id="question" name="question" required>
                </div>

                <button type="button" class="btn btn-success" onclick="previousStep()">Previous</button>
                <button type="button" class="btn btn-success" onclick="nextStep()">Next</button>
            </form>
        </div>

        <div id="step3" style="display: none;">
            <h2>Create a Poll - Step 3</h2>
            <form id="createChoiceForm" method="post" action="{{ route('choices.store') }}">
                @csrf
                <div class="form-group">
                    <label for="choices_0">Choices:</label>
                        <input type="text" class="form-control" id="choices_0" name="[choices][]" required>
                        <input type="text" class="form-control" name="[choices][]" required>
                        <!-- Add more choice fields as needed -->
                </div>
                <!-- Add more choice fields as needed -->
                

                <button type="button" class="btn btn-success" onclick="previousStep()">Previous</button>
                <button type="submit" class="btn btn-primary">Create Poll</button>
            </form>
        </div>
    </div>

    <script>
        let currentStep = 1;

        function nextStep() {
            document.getElementById(`step${currentStep}`).style.display = 'none';
            currentStep++;
            document.getElementById(`step${currentStep}`).style.display = 'block';
        }

        function previousStep() {
            document.getElementById(`step${currentStep}`).style.display = 'none';
            currentStep--;
            document.getElementById(`step${currentStep}`).style.display = 'block';
        }

        let questionIndex = 1;

        function addChoice() {
            questionIndex++;
            let html = `<div class="form-group">
                            <label for="choices_${questionIndex}">Choices:</label>
                            <input type="text" class="form-control" id="choices_${questionIndex}" name="[choices][]" required>
                        </div>`;
            document.getElementById('choices').insertAdjacentHTML('beforeend', html);
        }

        function removeChoice() {
            if (questionIndex > 1) {
                document.getElementById(`choices_${questionIndex}`).remove();
                questionIndex--;
            }
        }


    </script>
@endsection
