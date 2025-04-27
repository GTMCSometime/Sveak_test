<?php

namespace App\Services;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class TotalScoreService  {
    private $users;

    public function __construct(private UserRepository $userRepository,
     private CalculateScoreService $calculateScoreService,
     private EntityManagerInterface $em) {
        $this->users = $this->userRepository->findAll();
    }

    public function getTotalScore(): int {
        $totalScore = 0;
        $score = 0;
        foreach ($this->users as $user) {
            $totalScore += $this->calculateScoreService->calculate($user);
            $user->setScore($score);
        }
        $this->em->flush();
        return $totalScore;
    }
}
