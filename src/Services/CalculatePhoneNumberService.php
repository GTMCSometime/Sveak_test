<?php

namespace App\Services;
use App\Entity\User;

class CalculatePhoneNumberService implements CalculateInterface  {
    public function calculate(User $user): int {
        $score = 0;
        switch (substr($user->getPhoneNumber(), 0, 3)) {
            case '923':
                $score += 10;
                break;
    
                case '906':
                    $score += 5;
                    break;
    
                    case '913':
                        $score += 3;
                        break;
    
                        default:
                            $score += 1;
                            break;
        }
        return $score;
    }

}