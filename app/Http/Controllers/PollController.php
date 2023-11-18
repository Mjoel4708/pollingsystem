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
        // Show the form to create a new poll
        // ...
    }

    public function store(PollRequest $request)
    {
        // Store a newly created poll
        $poll = $this->pollService->createPoll($request->validated());

        // Redirect to the poll details page
        // ...
    }

    public function show(Poll $poll)
    {
        // Display the specified poll
        // ...
    }

    public function edit(Poll $poll)
    {
        // Show the form to edit the poll
        // ...
    }

    public function update(PollRequest $request, Poll $poll)
    {
        // Check if the authenticated user is the owner of the poll
        $this->authorize('update', $poll);
        // Update the specified poll
        $this->pollService->updatePoll($poll, $request->validated());

        
        // Redirect to the poll details page
        // ...
    }

    public function destroy(Poll $poll)
    {
        // Check if the authenticated user is the owner of the poll
        $this->authorize('update', $poll);
        // Remove the specified poll
        $this->pollService->deletePoll($poll);

        // Redirect to the list of polls
        // ...
    }
}
