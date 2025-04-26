<?php

namespace App\Services;
use App\Repository\UserRepository;
use App\Scoring\AbstractScore;

class TotalScoreService extends AbstractScore{
    private $users;

    public function __construct(private UserRepository $userRepository) {
        $this->users = $this->userRepository->findAll();
    }

    public function getTotalScore(): int {
        foreach ($this->users as $user) {
            $this->score += $user->getUserScore()->getScore();
        }
        return $this->score;
    }
}
