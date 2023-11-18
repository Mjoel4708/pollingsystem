<?php

namespace App\Repositories;

use App\Models\Choice;

class ChoiceRepository
{
    public function updateChoice(Choice $choice, array $data)
    {
        return $choice->update($data);
    }

    public function deleteChoice(Choice $choice)
    {
        return $choice->delete();
    }

    public function getChoiceById($choiceId)
    {
        return Choice::findOrFail($choiceId);
    }

    public function getChoicesByQuestion($questionId)
    {
        return Choice::where('question_id', $questionId)->get();
    }
}
