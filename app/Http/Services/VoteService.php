<?php

namespace App\Services;

use App\Repositories\VoteRepository;

class VoteService
{
    private $voteRepository;

    public function __construct(VoteRepository $voteRepository)
    {
        $this->voteRepository = $voteRepository;
    }

    public function createVote(array $data)
    {
        return $this->voteRepository->createVote($data);
    }

    public function deleteVote(Vote $vote)
    {
        return $this->voteRepository->deleteVote($vote);
    }

    public function getVoteById($voteId)
    {
        return $this->voteRepository->getVoteById($voteId);
    }

    public function getVotesByUser($userId)
    {
        return $this->voteRepository->getVotesByUser($userId);
    }

    public function getVotesByChoice($choiceId)
    {
        return $this->voteRepository->getVotesByChoice($choiceId);
    }

    public function getUserVoteForChoice($userId, $choiceId)
    {
        return $this->voteRepository->getUserVoteForChoice($userId, $choiceId);
    }

    public function hasUserVoted($userId, $choiceId)
    {
        return $this->voteRepository->hasUserVoted($userId, $choiceId);
    }

}
