<?php

namespace App\Services;
use App\Entity\User;

class CalculateScoreService extends AbstractScore {
    private $user;

    public function calculate(User $user): int {

    switch (substr($user->getPhoneNumber(), 0, 3)) {
        case '923':
            $this->score += 10;
            break;

            case '906':
                $this->score += 5;
                break;

                case '913':
                    $this->score += 3;
                    break;

                    default:
                        $this->score += 1;
                        break;
    }


    preg_match('|@([0-9a-zA-Z]+)\.|i', $user->getEmail(), $match);
    
    switch ($match[1]) {
        case 'gmail':
            $this->score += 10;
            break;

            case 'yandex':
                $this->score += 8;
                break;

                case 'mail':
                    $this->score += 6;
                    break;

                    default:
                    $this->score += 3;
                    break;
    }

    switch ($user->getEducation()) {
        case 'higher':
            $this->score += 15;
            break;

            case 'special':
                $this->score += 10;
                break;

                case 'secondary':
                    $this->score += 5;
                    break;
    }

    $user->getAgreeTerms() === true ? $this->score += 4 : $this->score += 0;
    return $this->score;
}
}
