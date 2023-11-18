<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateQuestionRequest;
use App\Services\QuestionService;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    private $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    public function create($pollId)
    {
        // Display the form to create a new question for a specific poll
        return view('questions.create', compact('pollId'));
    }

    public function store(CreateQuestionRequest $request, $pollId)
    {
        // Store a new question for the specific poll
        $this->questionService->createQuestion($request->validated(), $pollId);

        return redirect()->route('polls.show', $pollId)->with('success', 'Question created successfully.');
    }

    public function edit($pollId, $questionId)
    {
        $question = $this->questionService->getQuestionById($questionId);
        return view('questions.edit', compact('pollId', 'question'));
    }

    public function update(UpdateQuestionRequest $request, $pollId, $questionId)
    {
        $question = $this->questionService->getQuestionById($questionId);
        $this->questionService->updateQuestion($question, $request->validated());

        return redirect()->route('polls.show', $pollId)->with('success', 'Question updated successfully.');
    }

    public function destroy($pollId, $questionId)
    {
        $question = $this->questionService->getQuestionById($questionId);
        $this->questionService->deleteQuestion($question);

        return redirect()->route('polls.show', $pollId)->with('success', 'Question deleted successfully.');
    }

    public function show($pollId, $questionId)
    {
        $question = $this->questionService->getQuestionWithChoices($questionId);
        return view('questions.show', compact('pollId', 'question'));
    }

    public function showWithChoices($pollId, $questionId)
    {
        $question = $this->questionService->getQuestionWithChoices($questionId);
        return view('questions.show_with_choices', compact('pollId', 'question'));
    }

    public function createChoice($pollId, $questionId)
    {
        return view('choices.create', compact('pollId', 'questionId'));
    }

    public function storeChoice(Request $request, $pollId, $questionId)
    {
        $question = $this->questionService->getQuestionById($questionId);
        $this->questionService->addChoiceToQuestion($question, $request->validated());

        return redirect()->route('questions.show', ['pollId' => $pollId, 'questionId' => $questionId])->with('success', 'Choice added successfully.');
    }

    public function editChoice($pollId, $questionId, $choiceId)
    {
        $question = $this->questionService->getQuestionById($questionId);
        $choice = $this->questionService->getChoiceById($choiceId);
        return view('choices.edit', compact('pollId', 'questionId', 'choice'));
    }

    public function updateChoice(Request $request, $pollId, $questionId, $choiceId)
    {
        $question = $this->questionService->getQuestionById($questionId);
        $this->questionService->updateChoiceInQuestion($question, $choiceId, $request->validated());

        return redirect()->route('questions.show', ['pollId' => $pollId, 'questionId' => $questionId])->with('success', 'Choice updated successfully.');
    }

    public function destroyChoice($pollId, $questionId, $choiceId)
    {
        $question = $this->questionService->getQuestionById($questionId);
        $this->questionService->deleteChoiceInQuestion($question, $choiceId);

        return redirect()->route('questions.show', ['pollId' => $pollId, 'questionId' => $questionId])->with('success', 'Choice deleted successfully.');
    }
}
