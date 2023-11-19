<?php

class PollRepository
{
    public function getAll()
    {
        return Poll::all();
    }

    public function getPaginatedPolls()
    {
        return Poll::paginate(10);
    }

    public function createPoll(array $data)
    {
        return Poll::create($data);
    }

    public function updatePoll(Poll $poll, array $data)
    {
        $poll->update($data);
    }

    public function deletePoll(Poll $poll)
    {
        $poll->delete();
    }

    public function getPollBySlug($slug)
    {
        return Poll::where('slug', $slug)->firstOrFail();
    }

    public function getPollById($id)
    {
        return Poll::findOrFail($id);
    }

    public function getPollsByUserId($userId)
    {
        return Poll::where('user_id', $userId)->get();
    }

    public function getPollWithQuestions($pollId)
    {
        return Poll::with('questions')->findOrFail($pollId);
    }
}
