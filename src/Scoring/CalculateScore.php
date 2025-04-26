<?php

namespace App\Scoring;
use App\Entity\User;

class CalculateScore extends AbstractScore {
    private $user;
    private $phoneNumber;
    private $domain;
    private $education;
    private $agreeTerms;

    public function __construct(User $user) {
        $this->user = $user;
        $this->phoneNumber = $this->user->getPhoneNumber();
        $this->domain = $this->user->getEmail();
        $this->education = $this->user->getEducation();
        $this->agreeTerms = $this->user->getAgreeTerms();
    }
    

    public function setScore(): int {

    switch (substr($this->phoneNumber, 0, 3)) {
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


    preg_match('|@([0-9a-zA-Z]+)\.|i', $this->domain, $match);
    
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

    switch ($this->education) {
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

    $this->agreeTerms === true ? $this->score += 4 : $this->score += 0;
    return $this->score;
}
}
