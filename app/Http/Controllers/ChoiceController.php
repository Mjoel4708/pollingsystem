<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateChoiceRequest;
use App\Services\ChoiceService;
use Illuminate\Http\Request;

class ChoiceController extends Controller
{
    private $choiceService;

    public function __construct(ChoiceService $choiceService)
    {
        $this->choiceService = $choiceService;
    }

    public function edit($pollId, $questionId, $choiceId)
    {
        // authorize the user to update the choice
        $choice = $this->choiceService->getChoiceById($choiceId);
        return view('choices.edit', compact('pollId', 'questionId', 'choice'));
    }

    public function update(UpdateChoiceRequest $request, $pollId, $questionId, $choiceId)
    {
        $choice = $this->choiceService->getChoiceById($choiceId);
        $this->choiceService->updateChoice($choice, $request->validated());

        return redirect()->route('questions.show', ['pollId' => $pollId, 'questionId' => $questionId])->with('success', 'Choice updated successfully.');
    }

    public function destroy($pollId, $questionId, $choiceId)
    {
        $choice = $this->choiceService->getChoiceById($choiceId);
        $this->choiceService->deleteChoice($choice);

        return redirect()->route('questions.show', ['pollId' => $pollId, 'questionId' => $questionId])->with('success', 'Choice deleted successfully.');
    }

    public function show($pollId, $questionId, $choiceId)
    {
        $choices = $this->choiceService->showChoicesWithVotes($questionId);
        return view('choices.show', compact('pollId', 'questionId', 'choices'));
    }

    public function showWithVotes($pollId, $questionId, $choiceId)
    {
        $choices = $this->choiceService->showChoicesWithVotes($questionId);
        return view('choices.show_with_votes', compact('pollId', 'questionId', 'choices'));
    }

    public function showVotes($pollId, $questionId, $choiceId)
    {
        $votes = $this->choiceService->getVotesForChoice($choiceId);
        return view('choices.show_votes', compact('pollId', 'questionId', 'choiceId', 'votes'));
    }

    public function vote($pollId, $questionId, $choiceId)
    {
        // Logic to handle voting
        // You may want to implement this based on your requirements
    }

    public function unvote($pollId, $questionId, $choiceId)
    {
        // Logic to handle unvoting
        // You may want to implement this based on your requirements
    }
}
