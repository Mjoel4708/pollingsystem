<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PollController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ChoiceController;
use App\Http\Controllers\UserAuthenticationController;
use App\Http\Controllers\VoteController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});



// Register a new user
Route::post('/register', [UserAuthenticationController::class, 'register'])->name('register');

// Log in a user
Route::post('/login', [UserAuthenticationController::class, 'login'])->name('login');

// Log out a user
Route::post('/logout', [UserAuthenticationController::class, 'logout'])->name('logout');

// Display user profile
Route::get('/users/{userId}', [UserAuthenticationController::class, 'show'])->name('users.show');

// Update user profile
Route::put('/users/{userId}', [UserAuthenticationController::class, 'update'])->name('users.update');

// Change user password
Route::get('/users/{userId}/change-password', [UserAuthenticationController::class, 'changePassword'])->name('users.change_password');

// Update user password
Route::put('/users/{userId}/update-password', [UserAuthenticationController::class, 'updatePassword'])->name('users.update_password');

// Send email verification
Route::get('/users/{userId}/send-email-verification', [UserAuthenticationController::class, 'sendEmailVerification'])->name('users.send_email_verification');

// Verify email
Route::get('/users/{userId}/verify-email/{token}', [UserAuthenticationController::class, 'verifyEmail'])->name('users.verify_email');

// Index page showing a list of polls
Route::get('/polls', [PollController::class, 'index'])->name('polls.index');

// Display the form to create a new poll
Route::get('/polls/create', [PollController::class, 'create'])->name('polls.create');

// Store a newly created poll
Route::post('/polls', [PollController::class, 'store'])->name('polls.store');

// Display the details of a specific poll
Route::get('/polls/{poll}', [PollController::class, 'show'])->name('polls.show');

// Display the form to edit the specified poll
Route::get('/polls/{poll}/edit', [PollController::class, 'edit'])->name('polls.edit');

// Update the specified poll
Route::put('/polls/{poll}', [PollController::class, 'update'])->name('polls.update');

// Remove the specified poll
Route::delete('/polls/{poll}', [PollController::class, 'destroy'])->name('polls.destroy');


// Create a new question for a specific poll (Step 2)
Route::get('/polls/{pollId}/questions/create', [QuestionController::class, 'create'])->name('questions.create');
Route::post('/polls/{pollId}/questions/create', [QuestionController::class, 'store'])->name('questions.store');

// Edit a specific question
Route::get('/polls/{pollId}/questions/{questionId}/edit', [QuestionController::class, 'edit'])->name('questions.edit');
Route::put('/polls/{pollId}/questions/{questionId}/edit', [QuestionController::class, 'update'])->name('questions.update');

// Delete a specific question
Route::delete('/polls/{pollId}/questions/{questionId}', [QuestionController::class, 'destroy'])->name('questions.destroy');

// Show all questions for a specific poll
Route::get('/polls/{pollId}/questions', [QuestionController::class, 'show'])->name('questions.show');

// Show a specific question along with its choices
Route::get('/polls/{pollId}/questions/{questionId}', [QuestionController::class, 'showWithChoices'])->name('questions.show_with_choices');


// Edit a specific choice within a question (Step 3)
Route::get('/polls/{pollId}/questions/{questionId}/choices/{choiceId}/edit', [ChoiceController::class, 'edit'])->name('choices.edit');
Route::put('/polls/{pollId}/questions/{questionId}/choices/{choiceId}/edit', [ChoiceController::class, 'update'])->name('choices.update');

// Delete a specific choice within a question
Route::delete('/polls/{pollId}/questions/{questionId}/choices/{choiceId}', [ChoiceController::class, 'destroy'])->name('choices.destroy');

// Show all choices for a specific question
Route::get('/polls/{pollId}/questions/{questionId}/choices', [ChoiceController::class, 'show'])->name('choices.show');

// Show a specific choice along with its votes
Route::get('/polls/{pollId}/questions/{questionId}/choices/{choiceId}', [ChoiceController::class, 'showWithVotes'])->name('choices.show_with_votes');

// Show votes for a specific choice
Route::get('/polls/{pollId}/questions/{questionId}/choices/{choiceId}/votes', [ChoiceController::class, 'showVotes'])->name('choices.show_votes');

// Vote for a specific choice
Route::post('/polls/{pollId}/questions/{questionId}/choices/{choiceId}/vote', [ChoiceController::class, 'vote'])->name('choices.vote');

// Unvote for a specific choice
Route::post('/polls/{pollId}/questions/{questionId}/choices/{choiceId}/unvote', [ChoiceController::class, 'unvote'])->name('choices.unvote');

// Vote for a choice
Route::post('/votes', [VoteController::class, 'store'])->name('votes.store');

// Unvote for a choice
Route::delete('/votes/{voteId}', [VoteController::class, 'destroy'])->name('votes.destroy');

// Show details of a specific vote
Route::get('/votes/{voteId}', [VoteController::class, 'show'])->name('votes.show');

// Show all votes submitted by a specific user
Route::get('/votes/users/{userId}', [VoteController::class, 'showUserVotes'])->name('votes.show_user_votes');

// Show all votes for a specific choice
Route::get('/votes/choices/{choiceId}', [VoteController::class, 'showChoiceVotes'])->name('votes.show_choice_votes');

// Show voting status for a specific user and choice
Route::get('/votes/status/{userId}/{choiceId}', [VoteController::class, 'voteStatus'])->name('votes.vote_status');

// Toggle between voting and unvoting for a specific choice
Route::post('/votes/toggle/{choiceId}', [VoteController::class, 'voteOrUnvote'])->name('votes.vote_or_unvote');