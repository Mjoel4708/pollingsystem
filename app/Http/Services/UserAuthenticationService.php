<?php

namespace App\Services;

use App\Repositories\UserAuthenticationRepository;
use Illuminate\Support\Facades\Auth;

class UserAuthenticationService
{
    private $userAuthenticationRepository;

    public function __construct(UserAuthenticationRepository $userAuthenticationRepository)
    {
        $this->userAuthenticationRepository = $userAuthenticationRepository;
    }

    public function registerUser(array $data)
    {
        return $this->userAuthenticationRepository->createUser($data);
    }

    public function attemptLogin(array $credentials)
    {
        return Auth::attempt($credentials);
    }

    public function logoutUser()
    {
        Auth::logout();
    }

    public function getUserById($userId)
    {
        return User::findOrFail($userId);
    }

    public function updateUser(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }

    public function changePassword(User $user, $newPassword)
    {
        $user->update(['password' => Hash::make($newPassword)]);
    }

    public function sendEmailVerification(User $user)
    {
        event(new Registered($user));
    }

    public function verifyEmail($userId, $token)
    {
        $user = $this->getUserById($userId);

        if (!$user->hasVerifiedEmail()) {
            $user->markEmailAsVerified();
        }
    }
}
