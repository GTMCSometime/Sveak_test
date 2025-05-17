<?php

namespace App\Services;
use App\Entity\User;

class CalculateEducationService implements CalculateInterface  {
    public function calculate(User $user): int {
        $score = 0;
        switch ($user->getEducation()) {
            case 'higher':
                $score += 15;
                break;

                case 'special':
                    $score += 10;

                    case 'secondary':
                        $score += 5;
                        break;
        }
    return $score;
    }

}