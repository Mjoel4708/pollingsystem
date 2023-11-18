<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VoteController extends Controller
{
    private $voteService;

    public function __construct(VoteService $voteService)
    {
        $this->voteService = $voteService;
    }

    public function store(CreateVoteRequest $request)
    {
        $data = $request->validated();
        $this->voteService->createVote($data);

        return redirect()->back()->with('success', 'Vote submitted successfully.');
    }

    public function destroy($voteId)
    {
        $vote = $this->voteService->getVoteById($voteId);
        $this->voteService->deleteVote($vote);

        return redirect()->back()->with('success', 'Vote deleted successfully.');
    }

    public function show($voteId)
    {
        $vote = $this->voteService->getVoteById($voteId);
        return view('votes.show', compact('vote'));
    }

    public function showUserVotes($userId)
    {
        $votes = $this->voteService->getVotesByUser($userId);
        return view('votes.show_user_votes', compact('votes'));
    }

    public function showChoiceVotes($choiceId)
    {
        $votes = $this->voteService->getVotesByChoice($choiceId);
        return view('votes.show_choice_votes', compact('votes'));
    }

    public function voteStatus($userId, $choiceId)
    {
        $hasVoted = $this->voteService->hasUserVoted($userId, $choiceId);
        return view('votes.vote_status', compact('hasVoted'));
    }

    public function voteOrUnvote($choiceId)
    {
        $userId = auth()->user()->id;
        $hasVoted = $this->voteService->hasUserVoted($userId, $choiceId);

        if ($hasVoted) {
            $vote = $this->voteService->getUserVoteForChoice($userId, $choiceId);
            $this->voteService->deleteVote($vote);
            $choice = $this->choiceService->getChoiceById($choiceId);
            $voteCount = count($choice->votes);
            // Broadcast the event
            broadcast(new VoteUpdated($choice->id, $voteCount));
            return redirect()->back()->with('success', 'Vote deleted successfully.');
        }

        $data = [
            'choice_id' => $choiceId,
            'user_id' => $userId
        ];

        $this->voteService->createVote($data);
        $choice = $this->choiceService->getChoiceById($choiceId);
        $voteCount = count($choice->votes);
        // Broadcast the event
        broadcast(new VoteUpdated($choice->id, $voteCount));
        return redirect()->back()->with('success', 'Vote submitted successfully.');
    }
}
