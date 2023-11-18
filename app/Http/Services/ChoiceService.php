<?php

namespace App\Services;

use App\Models\Choice;
use App\Repositories\ChoiceRepository;

class ChoiceService
{
    private $choiceRepository;

    public function __construct(ChoiceRepository $choiceRepository)
    {
        $this->choiceRepository = $choiceRepository;
    }

    public function updateChoice(Choice $choice, array $data)
    {
        return $this->choiceRepository->updateChoice($choice, $data);
    }

    public function deleteChoice(Choice $choice)
    {
        return $this->choiceRepository->deleteChoice($choice);
    }

    public function getChoiceById($choiceId)
    {
        return $this->choiceRepository->getChoiceById($choiceId);
    }

    public function getChoicesByQuestion($questionId)
    {
        return $this->choiceRepository->getChoicesByQuestion($questionId);
    }

    // Add other methods as needed
}
