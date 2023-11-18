<?php

namespace App\Repositories;

use App\Models\User;

class UserAuthenticationRepository
{
    public function createUser(array $data)
    {
        return User::create($data);
    }

    // Add other methods as needed
}
