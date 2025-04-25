<?php

namespace App\Service;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class TotalScore {
    private $score;
    private $users;

    public function __construct(private UserRepository $userRepository, private EntityManagerInterface $em) {
        $this->score = 0;
        $this->users = $this->userRepository->findAll();
    }

    public function getTotalScore(): int {
        foreach ($this->users as $user) {
            $this->score = $user->getUserScore();
        }
        return $this->score;
    }
}
