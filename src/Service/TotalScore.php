<?php

namespace App\Service;
use App\Repository\UserRepository;

class TotalScore {
    private $score;
    private $users;

    public function __construct(private UserRepository $userRepository) {
        $this->score = 0;
        $this->users = $this->userRepository->findAll();
    }

    public function getTotalScore(): int {
        foreach ($this->users as $user) {
            $this->score += $user->getUserScore()->getScore();
        }
        return $this->score;
    }
}
