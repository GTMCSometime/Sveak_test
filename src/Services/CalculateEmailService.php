<?php

namespace App\Services;
use App\Entity\User;

class CalculateEmailService implements CalculateInterface  {
    public function calculate(User $user): int {
        $score = 0;
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
    return $score;
    }

}