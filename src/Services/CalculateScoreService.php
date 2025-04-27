<?php

namespace App\Services;
use App\Entity\User;

class CalculateScoreService  {

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


    preg_match('|@([0-9a-zA-Z]+)\.|i', $user->getEmail(), $match);
    
    switch ($match[1]) {
        case 'gmail':
            $score += 10;
            break;

            case 'yandex':
                $score += 8;
                break;

                case 'mail':
                    $score += 6;
                    break;

                    default:
                    $score += 3;
                    break;
    }

    switch ($user->getEducation()) {
        case 'higher':
            $score += 15;
            break;

            case 'special':
                $score += 10;
                break;

                case 'secondary':
                    $score += 5;
                    break;
    }

    $user->getAgreeTerms() === true ? $score += 4 : $score += 0;
    return $score;
}
}
