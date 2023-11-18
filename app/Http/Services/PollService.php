<?php
// app/Services/PollService.php

namespace App\Services;

use App\Models\Poll;
use PollRepository;

class PollService
{
    private $pollRepository;

    public function __construct(PollRepository $pollRepository)
    {
        $this->pollRepository = $pollRepository;
    }
    
    public function createPoll(array $data): Poll
    {
        // Validate that a poll with the same title doesn't exist
        $this->validateUniqueTitle($data['title']);

        // Automatically generate a unique slug if one is not provided
        $data['slug'] = $this->generateUniqueSlug($data['slug'] ?? $data['title']);


        // Create the poll
        $poll = PollRepository::createPoll($data);

        return $poll;

    }

    public function updatePoll(Poll $poll, array $data): Poll
    {
        // Validate that a poll with the same title doesn't exist
        $this->validateUniqueTitle($data['title'], $poll->id);

        // Automatically generate a unique slug if one is not provided
        $data['slug'] = $this->generateUniqueSlug($data['slug'] ?? $data['title'], $poll->id);

        // Update the poll
        PollRepository::updatePoll($poll, $data);

        return $poll;
    }

    public function deletePoll(Poll $poll)
    {
        PollRepository::deletePoll($poll);
    }

    public function getPollBySlug($slug): Poll
    {
        return PollRepository::getPollBySlug($slug);
    }

    public function getPollById($id): Poll
    {
        return PollRepository::getPollById($id);
    }

    public function getPollsByUserId($userId)
    {
        return PollRepository::getPollsByUserId($userId);
    }

    public function getPaginatedPolls()
    {
        return PollRepository::getPaginatedPolls();
    }

    protected function validateUniqueTitle($title, $id = null)
    {
        $poll = Poll::where('title', $title);

        if ($id) {
            $poll->where('id', '!=', $id);
        }

        if ($poll->exists()) {
            throw new \Exception('A poll with the same title already exists.');
        }
    }

    protected function generateUniqueSlug($slug, $id = null)
    {
        $originalSlug = $slug;
        $i = 1;

        while (Poll::where('slug', $slug)->where('id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $i++;
        }

        return $slug;
    }

       


}
