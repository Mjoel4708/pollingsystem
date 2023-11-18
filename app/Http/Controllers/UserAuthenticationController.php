<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UserAuthenticationRequest;
use App\Services\UserAuthenticationService;

class UserAuthenticationController extends Controller
{
    private $userAuthenticationService;

    public function __construct(UserAuthenticationService $userAuthenticationService)
    {
        $this->userAuthenticationService = $userAuthenticationService;
    }

    public function register(UserAuthenticationRequest $request)
    {
        $data = $request->validated();
        $user = $this->userAuthenticationService->registerUser($data);

        // Additional logic if needed, e.g., sending a verification email

        return response()->json(['message' => 'User registered successfully', 'user' => $user]);
    }

    public function login(UserAuthenticationRequest $request)
    {
        $credentials = $request->only(['email', 'password']);

        if ($this->userAuthenticationService->attemptLogin($credentials)) {
            return response()->json(['message' => 'Login successful', 'token' => auth()->user()->createToken('auth-token')->plainTextToken]);
        }

        return response()->json(['message' => 'Invalid credentials'], 401);
    }

    public function logout()
    {
        $this->userAuthenticationService->logoutUser();

        return response()->json(['message' => 'Logout successful']);
    }
    
    public function show($userId)
    {
        $user = $this->userAuthenticationService->getUserById($userId);
        return view('users.show', compact('user'));
    }

    public function update(UserAuthenticationRequest $request, $userId)
    {
        $user = $this->userAuthenticationService->getUserById($userId);
        $this->userAuthenticationService->updateUser($user, $request->validated());

        return redirect()->route('users.show', $userId)->with('success', 'User updated successfully.');
    }

    public function changePassword($userId)
    {
        $user = $this->userAuthenticationService->getUserById($userId);
        return view('users.change_password', compact('user'));
    }

    public function updatePassword(UserAuthenticationRequest $request, $userId)
    {
        $user = $this->userAuthenticationService->getUserById($userId);
        $this->userAuthenticationService->changePassword($user, $request->input('password'));

        return redirect()->route('users.show', $userId)->with('success', 'Password changed successfully.');
    }

    public function sendEmailVerification($userId)
    {
        $user = $this->userAuthenticationService->getUserById($userId);
        $this->userAuthenticationService->sendEmailVerification($user);

        return redirect()->route('users.show', $userId)->with('success', 'Email verification sent.');
    }

    public function verifyEmail($userId, $token)
    {
        $this->userAuthenticationService->verifyEmail($userId, $token);

        return redirect()->route('login')->with('success', 'Email verified successfully.');
    }
}
