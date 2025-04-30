<?php

namespace App\Services;
use App\Entity\User;

class CalculateScoreService  {
    private array $details = [ 
        'phoneNumber' => 0,
        'email' => 0,
        'education' => 0,
        'agree' => 0,
        'score' => 0,
    ]; 

    public function calculatePhoneNumber(User $user): int {
        $score = 0;
        switch (substr($user->getPhoneNumber(), 0, 3)) {
            case '923':
                $score += 10;
                $this->details['phoneNumber'] = 10;
                break;
    
                case '906':
                    $score += 5;
                    $this->details['phoneNumber'] = 5;
                    break;
    
                    case '913':
                        $score += 3;
                        $this->details['phoneNumber'] = 3;
                        break;
    
                        default:
                            $score += 1;
                            $this->details['phoneNumber'] = 1;
                            break;
        }
        return $score;
    }

    public function calculateEmail(User $user): int {
        $score = 0;
        preg_match('|@([0-9a-zA-Z]+)\.|i', $user->getEmail(), $match);

        switch ($match[1]) {
            case 'gmail':
                $score += 10;
                $this->details['email'] = 10;
                break;

                case 'yandex':
                    $score += 8;
                    $this->details['email'] = 8;
                    break;

                    case 'mail':
                        $score += 6;
                        $this->details['email'] = 6;
                        break;

                        default:
                        $score += 3;
                        $this->details['email'] = 3;
                        break;
        }
    return $score;
    }
    
    public function calculateEducation(User $user): int {
        $score = 0;
        switch ($user->getEducation()) {
            case 'higher':
                $score += 15;
                $this->details['education'] = 15;
                break;

                case 'special':
                    $score += 10;
                    $this->details['education'] = 10;
                    break;

                    case 'secondary':
                        $score += 5;
                        $this->details['education'] = 5;
                        break;
        }
    return $score;
    }

    public function calculateAgree(User $user): int {
        $score = 0;
        switch($user->getAgreeTerms()) {
            case true:
                $score += 4;
                $this->details['agree'] = 4;
                break;
    
                case false:
                    $score += 0;
                    $this->details['agree'] = 0;
                    break;
        }
    return $score;
    }

    public function calculateTotalScore(User $user): int {
        $total = 0;

        $total = $this->calculateEducation($user) + 
            $this->calculateAgree($user) + 
            $this->calculatePhoneNumber($user) + 
            $this->calculateEmail($user);

        return $total;
}

    public function scoreDetails(User $user): array {
        $this->details['score'] = $this->calculateTotalScore($user);
        return $this->details;
    }

}