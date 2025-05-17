<?php

namespace App\Services;
use App\Entity\User;

class CalculateAgreeService implements CalculateInterface  {
    public function calculate(User $user): int {
        $score = 0;
        switch($user->getAgreeTerms()) {
            case true:
                $score += 4;
                break;
    
                case false:
                    $score += 0;
                    break;
        }
    return $score;
    }

}