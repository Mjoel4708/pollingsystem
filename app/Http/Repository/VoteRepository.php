<?php

namespace App\Repositories;

use App\Models\Vote;

class VoteRepository
{
    public function createVote(array $data)
    {
        return Vote::create($data);
    }

    // Add other methods as needed
}
