<?php

namespace App\Services;
use App\Entity\User;

class CalculateScoreService  {

    public function calculate(User $user, $flag = false): int|array {
        
    $score = 0;
    $details = [ 
        'phoneNumber' => 0,
        'email' => 0,
        'education' => 0,
        'agree' => 0,
        'score' => 0,
    ];

    switch (substr($user->getPhoneNumber(), 0, 3)) {
        case '923':
            $score += 10;
            $details['phoneNumber'] = 10;
            break;

            case '906':
                $score += 5;
                $details['phoneNumber'] = 5;
                break;

                case '913':
                    $score += 3;
                    $details['phoneNumber'] = 3;
                    break;

                    default:
                        $score += 1;
                        $details['phoneNumber'] = 1;
                        break;
    }


    preg_match('|@([0-9a-zA-Z]+)\.|i', $user->getEmail(), $match);
    
    switch ($match[1]) {
        case 'gmail':
            $score += 10;
            $details['email'] = 10;
            break;

            case 'yandex':
                $score += 8;
                $details['email'] = 8;
                break;

                case 'mail':
                    $score += 6;
                    $details['email'] = 6;
                    break;

                    default:
                    $score += 3;
                    $details['email'] = 3;
                    break;
    }

    switch ($user->getEducation()) {
        case 'higher':
            $score += 15;
            $details['education'] = 15;
            break;

            case 'special':
                $score += 10;
                $details['education'] = 10;
                break;

                case 'secondary':
                    $score += 5;
                    $details['education'] = 5;
                    break;
    }

    switch($user->getAgreeTerms()) {
        case true:
            $score += 4;
            $details['agree'] = 4;
            break;

            case false:
                $score += 0;
                $details['agree'] = 0;
                break;
    }
    
    if($flag === false) {
        return $score;
    } else {
        $details['score'] = $score;
        return $details;
    }

}
}
