<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PollPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        // ...
    }

    public function update(User $user, Poll $poll)
    {
        return $user->id === $poll->user_id;
    }

    public function delete(User $user, Poll $poll)
    {
        return $user->id === $poll->user_id;
    }

}
