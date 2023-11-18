<?php

namespace App\Repositories;

use App\Models\Question;

class QuestionRepository
{
    public function createQuestion(array $data, $pollId)
    {
        return Question::create(array_merge($data, ['poll_id' => $pollId]));
    }

    public function updateQuestion(Question $question, array $data)
    {
        return $question->update($data);
    }

    public function deleteQuestion(Question $question)
    {
        return $question->delete();
    }

    public function getQuestionById($questionId)
    {
        return Question::findOrFail($questionId);
    }

    public function getQuestionsByPoll($pollId)
    {
        return Question::where('poll_id', $pollId)->get();
    }

    public function getQuestionWithChoices($questionId)
    {
        return Question::with('choices')->findOrFail($questionId);
    }

    public function addChoiceToQuestion(Question $question, array $choiceData)
    {
        return $question->choices()->create($choiceData);
    }

    public function updateChoiceInQuestion(Question $question, $choiceId, array $choiceData)
    {
        $choice = $question->choices()->findOrFail($choiceId);
        $choice->update($choiceData);

        return $choice;
    }

    public function deleteChoiceInQuestion(Question $question, $choiceId)
    {
        $choice = $question->choices()->findOrFail($choiceId);
        $choice->delete();

        return $choice;
    }
}