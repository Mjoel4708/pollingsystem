<?php

namespace App\Http\Controllers;

use App\Http\Requests\PollRequest;
use App\Models\Poll;
use App\Services\PollService;

class PollController extends Controller
{
    protected $pollService;

    public function __construct(PollService $pollService)
    {
        $this->pollService = $pollService;
    }

    public function index()
    {
        $polls = $this->pollService->getPaginatedPolls();

    }

    public function create()
    {
        // Display the form to create a new poll
        return view('polls.create');
    }

    public function store(PollRequest $request)
    {
        // Store a newly created poll
        $poll = $this->pollService->createPoll($request->validated());

        // Redirect to the question creation page with the poll ID
        return redirect()->route('polls.index', \compact('poll'))->with('success', 'Poll created successfully.');
    }

    public function show(Poll $poll)
    {
        // Check if the authenticated user is the owner of the poll
        $this->authorize('update', $poll);
        $poll = $this->pollService->getPollWithQuestions($poll->id);
        return view('polls.show', compact('poll'));
    }

    public function edit(Poll $poll)
    {
        // Check if the authenticated user is the owner of the poll
        $this->authorize('update', $poll);
        // Display the form to edit the specified poll
        return view('polls.edit', compact('poll'));
    }

    public function update(PollRequest $request, Poll $poll)
    {
       
        // Check if the authenticated user is the owner of the poll
        $this->authorize('update', $poll);
        // Update the specified poll
        $this->pollService->updatePoll($poll, $request->validated());

        
        // Redirect to the poll details page
        return redirect()->route('polls.index', \compact('poll'))->with('success', 'Poll updated successfully.');
    }

    public function destroy(Poll $poll)
    {
        // Check if the authenticated user is the owner of the poll
        $this->authorize('update', $poll);
        // Remove the specified poll
        $this->pollService->deletePoll($poll);

        // Redirect to the polls list page
        return redirect()->route('polls.index');
    }
}
