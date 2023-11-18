<?php

namespace App\Services;

use App\Models\Question;
use App\Repositories\QuestionRepository;

class QuestionService
{
    private $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function createQuestion(array $data, $pollId)
    {
        return $this->questionRepository->createQuestion($data, $pollId);
    }

    public function updateQuestion(Question $question, array $data)
    {
        return $this->questionRepository->updateQuestion($question, $data);
    }

    public function deleteQuestion(Question $question)
    {
        return $this->questionRepository->deleteQuestion($question);
    }

    public function getQuestionById($questionId)
    {
        return $this->questionRepository->getQuestionById($questionId);
    }

    public function getQuestionsByPoll($pollId)
    {
        return $this->questionRepository->getQuestionsByPoll($pollId);
    }

    public function getQuestionWithChoices($questionId)
    {
        return $this->questionRepository->getQuestionWithChoices($questionId);
    }

    public function addChoiceToQuestion(Question $question, array $choiceData)
    {
        return $this->questionRepository->addChoiceToQuestion($question, $choiceData);
    }

    public function updateChoiceInQuestion(Question $question, $choiceId, array $choiceData)
    {
        return $this->questionRepository->updateChoiceInQuestion($question, $choiceId, $choiceData);
    }

    public function deleteChoiceInQuestion(Question $question, $choiceId)
    {
        return $this->questionRepository->deleteChoiceInQuestion($question, $choiceId);
    }
}
