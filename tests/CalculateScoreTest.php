<?php

namespace App\Tests;

use App\Entity\User;
use App\Scoring\CalculateScore;
use PHPUnit\Framework\TestCase;

class CalculateScoreTest extends TestCase
{
    public function testCalculateScore(): void
    {
        $user = new User();
        $user->setName('Test');
        $user->setSurname('Testovich');
        $user->setPhoneNumber('9232295589'); // +10
        $user->setEmail('test@gmail.com'); // +10
        $user->setEducation('higher'); // +15        
        $user->setAgreeTerms(true); // +4
        $score = new CalculateScore($user)->calculate();
        $exp = 39;
        $this->assertEquals($exp, $score);
    }
}
